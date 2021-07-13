<?php
namespace app\components;
include \Yii::getAlias('@app') . '/components/phmagick-master/phMagick/phMagick.php';
class WordPhp
{
	protected $step;
	private $debug = false;
	private $file;
	private $rels_xml;
	private $doc_xml;
	private $doc_media = [];
	private $last = 'none';
	private $encoding = 'ISO-8859-1';
	private $tmpDir = 'tmp';
	private $dir;
	private $dir2;
	public $f = 0;
	public $arr = [];
	/**
	 * CONSTRUCTOR
	 *
	 * @param Boolean $debug Debug mode or not
	 * @return void
	 */
	public function __construct($debug_=null, $encoding=null)
	{
		$step = 0;
		if($debug_ != null) {
			$this->debug = $debug_;
		}
		if ($encoding != null) {
			$this->encoding = $encoding;
		}
		$this->tmpDir = dirname(__FILE__);
	}

	/**
	 * Sets the tmp directory where images will be stored
	 *
	 * @param string $tmp The location
	 * @return void
	 */
	private function setTmpDir($tmp)
	{
		$this->tmpDir = $tmp;
	}

	/**
	 * READS The Document and Relationships into separated XML files
	 *
	 * @param var $object The class variable to set as \DOMDocument
	 * @param var $xml The xml file
	 * @param string $encoding The encoding to be used
	 * @return void
	 */
	private function setXmlParts(&$object, $xml, $encoding)
	{
		$object = new \DOMDocument();
		$object->encoding = $encoding;
		$object->preserveWhiteSpace = false;
		$object->formatOutput = true;
		$object->loadXML($xml);
		$object->saveXML();
	}

	/**
	 * READS The Document and Relationships into separated XML files
	 *
	 * @param String $filename The filename
	 * @return void
	 */
	private function readZipPart($filename)
	{
		$this->dir = \Yii::getAlias('@app') . '/web/tmp/' . time() . '-' . $this->f;
		
		$this->f = $this->f + 1;

		mkdir($this->dir);
		$zip = new \ZipArchive();
		$_xml = 'word/document.xml';
		$_xml_rels = 'word/_rels/document.xml.rels';

		if (true === $zip->open($filename)) {
			if (($index = $zip->locateName($_xml)) !== false) {
				$xml = $zip->getFromIndex($index);
			}
			//Get the relationships
			if (($index = $zip->locateName($_xml_rels)) !== false) {
				$xml_rels = $zip->getFromIndex($index);
			}
			// load all images if they exist
			for ($i=0; $i<$zip->numFiles;$i++) {
            	$zip_element = $zip->statIndex($i);

            	if(preg_match("([^\s]+(\.(?i)(jpg|jpeg|png|gif|bmp|wmf|emf))$)",$zip_element['name'])) {
            		$arr = explode('/', $zip_element['name']);
            		$path = $this->dir . '/' . end($arr);
            		file_put_contents($path, $zip->getFromIndex( $i ) );
            		$this->doc_media[$zip_element['name']] = $zip_element['name'];
	        	}
        	}
			$zip->close();
		} else die('non zip file');

		$enc = mb_detect_encoding($xml);
		$this->setXmlParts($this->doc_xml, $xml, $enc);
		$this->setXmlParts($this->rels_xml, $xml_rels, $enc);

		if($this->debug) {
			echo "<textarea style='width:100%; height: 200px;'>";
			echo $this->doc_xml->saveXML();
			echo "</textarea>";
			echo "<textarea style='width:100%; height: 200px;'>";
			echo $this->rels_xml->saveXML();
			echo "</textarea>";
		}
	}

	/**
	 * CHECKS THE FONT FORMATTING OF A GIVEN ELEMENT
	 * Currently checks and formats: bold, italic, underline, background color and font family
	 *
	 * @param XML $xml The XML node
	 * @return String HTML formatted code
	 */
	private function checkFormating(&$xml, $qq = false)
	{
		$node = trim($xml->readOuterXML());
		$t = '';
		// add <br> tags
		if (strstr($node,'<w:br ')) $t = '<br>';
		// look for formatting tags
		$f = "<span style='";
		$reader = new \XMLREADER();
		$reader->XML($node);
		$img = null;
		$q = false;
		$bold = false;
		$space = false;
		$italic = false;
		$texttext = '';
		$text = '';
		$start = false;
		$end = false;

		while ($reader->read()) {
			if($reader->getAttribute("xml:space") == 'preserve'){
				$space = true ;
			}
			if($reader->name == "w:b") {
				$bold = true;
			}
			if($reader->name == "w:i") {
				$italic = true;
			}
			if($reader->name == 'w:t'){
				$text = $reader->expand()->textContent;
				if($text && $text[0] == ' '){
					$start = true;
					// echo "<br>start";
				}
				elseif($text && $text[strlen($text) - 1] == ' '){
					$end = true;
					// echo "<br>end";
				}
			}
			if($reader->name == "w:vertAlign") {
				$q = true;
				$sub = substr($reader->getAttribute("w:val"),0,3);
			}
			if($reader->name == 'w:drawing' && !empty($reader->readInnerXml())) {
				$style = $reader->getAttribute("style");
				$image = $this->checkImageFormating($reader);
				$img = $image !== null ? "<image src='/".$image ."' style='".$style."'/>" : null;

				// $r = base64_encode(file_get_contents($image));
				// $file_type = substr(strrchr($image, "."), 1);
				// $img = $r !== null ? "<image src='".'data:image/'.$file_type.';base64,'.$r."' />" : null;
			}
			if($reader->name == 'v:shape' && !empty($reader->readInnerXml())){
				$style = $reader->getAttribute("style");
				$image = $this->checkImageFormating($reader);
				$img = $image !== null ? "<image src='/".$image ."' style='".$style."'/>" : null;

				// $r = base64_encode(file_get_contents($image));
				// $file_type = substr(strrchr($image, "."), 1);
				// $img = $r !== null ? "<image src='".'data:image/'.$file_type.';base64,'.$r."'  style='".$style."'/>" : null;
			}
		}

		// echo "<br><span style = 'background-color:red'>analiz</span><br>";
		$text = $xml->expand()->textContent;
		// echo "<br>kirish:<br><span style = 'background-color:pink'>" . $text . "</span><br>";

		if (!$qq)
			$text = trim($text);
		if($start){
			$text = ' ' . $text;
		}
		elseif($end){
			$text = $text . ' ';
		}

		// if ($texttext){
		// 	$text = $texttext;
		// }else{
		// 	$text = "";
		// }

		// if ($space && $text){
		// 	echo "<br>space<br>";
		// 	echo "<br>natija:<br><span style = 'background-color:yellow'>" . $text . "</span><br>";

		// 	if ($text[0] == ' '){
		// 		$text = ' ' . trim($text);
		// 		echo "<br> boshida<br>";
		// 	}
		// 	elseif ($text[strlen($text) - 1] == ' '){
		// 		echo "<br> oxirida<br>";
		// 		$text =  trim($text) . ' ';
		// 	}
		// }
		// echo "<br>natija:<br><span style = 'background-color:yellow'>" . $text . "</span><br>";
		// echo "<br><span style = 'background-color:red'>-------------</span><br>";

		$t .= ($img !== null ? $img : $text );

		if($bold){
			$t = "<strong>".$t."</strong>";
		}

		if($italic){
			$t = "<i>".$t."</i>";
		}

		if($q){
			return	"<$sub>".$t."</$sub>";
		}else{
			return $t;
		}
	}

	/**
	 * CHECKS THE ELEMENT FOR UL ELEMENTS
	 * Currently under development
	 *
	 * @param XML $xml The XML node
	 * @return String HTML formatted code
	 */
	private function getListFormating(&$xml)
	{
		$node = trim($xml->readOuterXML());

		$reader = new \XMLREADER();
		$reader->XML($node);
		$ret="";
		$close = "";
		while ($reader->read()){

			if($reader->name == "w:numPr" && $reader->nodeType == \XMLREADER::ELEMENT ) {

			}
			if($reader->name == "w:numId" && $reader->hasAttributes) {
				switch($reader->getAttribute("w:val")) {
					case 1:
						$ret['open'] = "<ol><li>";
						$ret['close'] = "</li></ol>";
						break;
					case 2:
						$ret['open'] = "<ul><li>";
						$ret['close'] = "</li></ul>";
						break;
				}

			}
		}
		return $ret;
	}

	/**
	 * CHECKS IF THERE IS AN IMAGE PRESENT
	 * Currently under development
	 *
	 * @param XML $xml The XML node
	 * @return String The location of the image
	 */
		private function checkImageFormating(&$xml)
	{
		$content = trim($xml->readInnerXml());

		if (!empty($content)) {

			$relId;
			$notfound = true;
			$reader = new \XMLREADER();
			$reader->XML($content);

			$q = true;
			$frame = [];
			while ($reader->read() && $notfound) {
				if ($reader->name == "a:blip") {
					$relId = $reader->getAttribute("r:embed");
					$q = false;
					// $notfound = false;
				}elseif($reader->name == "v:imagedata"){
					$relId = $reader->getAttribute("r:id");
					$notfound = false;
					$q = false;
				}elseif($reader->name == "a:srcRect"){
					$top = (int)$reader->getAttribute("t")/100000;
					$right = (int)$reader->getAttribute("r")/100000;
					$bottom = (int)$reader->getAttribute("b")/100000;
					$left = (int)$reader->getAttribute("l")/100000;
					$frame = [$top,$right,$bottom,$left];
					$notfound = false;
					$q = false;
				}
			}

			$notfound = $q;
			// image id found, get the image location
			if (!$notfound && $relId) {
				$reader = new \XMLREADER();
				$reader->XML($this->rels_xml->saveXML());

				while ($reader->read()) {

					if ($reader->nodeType == \XMLREADER::ELEMENT && $reader->name=='Relationship') {
						if($reader->getAttribute("Id") == $relId) {
							$link = "word/".$reader->getAttribute('Target');
							break;
						}
					}

				}

    			$zip = new \ZipArchive();
    			$im = null;
    			if (true === $zip->open($this->file)) {
        			$im = $this->createImage($zip->getFromName($link), $relId, $link, $frame);

    			}
    			$zip->close();
    			return $im;
			}
		}

		return null;
	}

	/**
	 * Creates an image in the filesystem
	 *
	 * @param objetc $image The image object
	 * @param string $relId The image relationship Id
	 * @param string $name The image name
	 * @return Array With HTML open and closing tag definition
	 */
	private function createImage($image, $relId, $name, $frame = [])
	{
		$arr = explode('.', $name);
		$l = count($arr);
		$ext = strtolower($arr[$l-1]);

		//$fname = $this->tmpDir.'/tmp/'.$relId.'.'.$ext;
		$fname = $this->dir . '/' .$relId.'.'.$ext;

		$q = false;
		if(array_sum($frame) != 0 && !empty($frame)){
			$top = $frame[0];
			$bottom = $frame[2];
			$right = $frame[1];
			$left = $frame[3];
			$q = true;
		}

		switch ($ext) {
			case 'png':
				$im = imagecreatefromstring($image);
				if($q){
					$x = imagesx($im);
					$y = imagesy($im);

					$im2 = imagecrop($im, ['x' => $x * $left, 'y' => $y * $top, 'width' => $x*(1 -$right-$left), 'height' => $y* (1 -$bottom-$top)]);
					if ($im2 !== FALSE) {
					    imagepng($im2, $fname);
					    imagedestroy($im2);
					}
				}else{
				    imagepng($im, $fname);
				}

				imagedestroy($im);
				break;
			case 'bmp':
				$im = imagecreatefromstring($image);
				if($q){
					$x = imagesx($im);
					$y = imagesy($im);
					$im2 = imagecrop($im, ['x' => $x * $left, 'y' => $y * $top, 'width' => $x*(1 -$right-$left), 'height' => $y* (1 -$bottom-$top)]);
					if ($im2 !== FALSE) {
					    imagebmp($im2, $fname);
					    imagedestroy($im2);
					}
				}else{
				    imagepng($im, $fname);
				}

				imagedestroy($im);
				break;
			case 'gif':
				$im = imagecreatefromstring($image);
				if($q){
					$x = imagesx($im);
					$y = imagesy($im);
					$im2 = imagecrop($im, ['x' => $x * $left, 'y' => $y * $top, 'width' => $x*(1 -$right-$left), 'height' => $y* (1 -$bottom-$top)]);
					if ($im2 !== FALSE) {
					imagegif($im, $fname);
						imagejpeg($im2, $fname);
					    imagedestroy($im2);
					}
				}else{
				    imagepng($im, $fname);
				}

				imagedestroy($im);
				break;
			case 'jpeg':
			case 'jpg':
				$im = imagecreatefromstring($image);
				if($q){
					$x = imagesx($im);
					$y = imagesy($im);
					$im2 = imagecrop($im, ['x' => $x * $left, 'y' => $y * $top, 'width' => $x*(1 -$right-$left), 'height' => $y* (1 -$bottom-$top)]);
					if ($im2 !== FALSE) {
					imagegif($im, $fname);
						imagejpeg($im2, $fname);
					    imagedestroy($im2);
					}
				}else{
				    imagepng($im, $fname);
				}

				imagedestroy($im);
				break;
			default:
				$q = false;
				$fname = $this->dir . '/' .$relId.'.jpg';
				$phMagick = new \phMagick\Core\Runner();
				$action = new \phMagick\Action\Convert($this->dir . '/' . explode('/', $name)[2], $fname);
				$phMagick->run($action);
				break;
		}

		$array = explode('/', $fname);
		$name = array_pop($array);
		$dir = array_pop($array);

		return 'tmp/' . $dir . '/' . $name;
	}

	/**
	 * CHECKS IF ELEMENT IS AN HYPERLINK
	 *
	 * @param XML $xml The XML node
	 * @return Array With HTML open and closing tag definition
	 */
	private function getHyperlink(&$xml)
	{
		$ret = array('open'=>'<ul>','close'=>'</ul>');
		$link ='';
		if($xml->hasAttributes) {
			$attribute = "";
			while($xml->moveToNextAttribute()) {
				if($xml->name == "r:id")
					$attribute = $xml->value;
			}

			if($attribute != "") {
				$reader = new \XMLREADER();
				$reader->XML($this->rels_xml->saveXML());

				while ($reader->read()) {
					if ($reader->nodeType == \XMLREADER::ELEMENT && $reader->name=='Relationship') {
						if($reader->getAttribute("Id") == $attribute) {
							$link = $reader->getAttribute('Target');
							break;
						}
					}
				}
			}
		}

		if($link != "") {
			$ret['open'] = "<a href='".$link."' target='_blank'>";
			$ret['close'] = "</a>";
		}

		return $ret;
	}


	/**
	 * PROCESS TABLE CONTENT
	 *
	 * @param XML $xml The XML node
	 * @return THe HTML code of the table
	 */
	private function checkTableFormating(&$xml)
	{
		$this->step++;
		$table = "<div>";

		while ($xml->read()) {
			if ($xml->nodeType == \XMLREADER::ELEMENT && $xml->name === 'w:tr') { //table row
				$tc = $ts = "";

				$tr = new \XMLREADER;
				$tr->xml(trim($xml->readOuterXML()));

				while ($tr->read()) {

					if ($tr->nodeType == \XMLREADER::ELEMENT && $tr->name === 'w:tcPr') { //table element properties
						$ts = $this->processTableStyle(trim($tr->readOuterXML()));
					}
					if ($tr->nodeType == \XMLREADER::ELEMENT && $tr->name === 'w:tc') { //table column
						$tc .= $this->processTableRow(trim($tr->readOuterXML()));
					}
				}
				$table .= "<span>" . $tc . "</span>";
				$this->arr[$this->step][] = $tc;
			}
		}

		$table .= "</div>";
		return $table;
	}

	/**
	 * PROCESS THE TABLE ROW STYLE
	 *
	 * @param string $content The XML node content
	 * @return THe HTML code of the table
	 */
	private function processTableStyle($content)
	{
		/*border-collapse:collapse;
		border-bottom:4px dashed #0000FF;
		border-top:6px double #FF0000;
		border-left:5px solid #00FF00;
		border-right:5px solid #666666;*/

		$tc = new \XMLREADER;
		$tc->xml($content);
		$style = "border-collapse:collapse;";

		while ($tc->read()) {
			if ($tc->name === "w:tcBorders") {
				$tc2 = new \SimpleXMLElement($tc->readOuterXML());

				foreach ($tc2->children('w',true) as $ch) {
					if (in_array($ch->getName(), ['left','top','botom','right']) ) {
						$line = $this->convertLine($ch['val']);
						$style .= " border-".$ch->getName().":".$ch['sz']."px $line #".$ch['color'].";";
					}
				}

				$tc->next();
			}
		}
		return $style;
	}

	private function convertLine($in)
	{
		if (in_array($in, ['dotted']))
			return "dashed";

		if (in_array($in, ['dotDash','dotdotDash','dotted','dashDotStroked','dashed','dashSmallGap']))
			return "dashed";

		if (in_array($in, ['double','triple','threeDEmboss','threeDEngrave','thick']))
			return "double";

		if (in_array($in, ['nil','none']))
			return "none";

		return "solid";
	}

	/**
	 * PROCESS THE TABLE ROW
	 *
	 * @param string $content The XML node content
	 * @return THe HTML code of the table
	 */
	private function processTableRow($content)
	{
		$tc = new \XMLREADER;
		$tc->xml($content);
		$ct = "";
		while ($tc->read()) {

            // echo "<pre>";
            // echo ($tc->name);
            // echo "</pre>";

            if ($tc->name === 'w:p') {
                $ct .= ($this->processTableRow2($tc->readOuterXML()));
				$tc->next();
                continue;
            }

			if ($tc->name === "w:r") {
				$ct .= $this->checkFormating($tc, true);
                // echo "<br><span style='background-color:pink'>".$this->checkFormating($tc)."</span><br>";
				$tc->next();
			}
			if ($tc->name === "m:oMath") {
				$ct .= '<span>'.$this->ommltomathml($tc, true).'</span>';
				$tc->next();
			}
		}
        // echo "<br><span style='background-color:red'>".$line."</span><br>";
		return $ct;
	}

    private function processTableRow2($content)
    {
        $tc = new \XMLREADER;
		$tc->xml($content);
		$ct = "";
        $line = '';
		while ($tc->read()) {
			if ($tc->name === "w:r") {
				$ct .= ($this->checkFormating($tc));
                // echo "<br><span style='background-color:yellow'>".$this->checkFormating($tc)."</span><br>";
                $line = $line . ($this->checkFormating($tc));
				$tc->next();
			}
			if ($tc->name === "m:oMath") {
				$ct .= '<span>'.$this->ommltomathml($tc).'</span>';
				$tc->next();
			}
		}
        // echo "<br><span style='background-color:green'>".$line."</span><br>";
		return $ct;
    }

	/**
	 * READS THE GIVEN DOCX FILE INTO HTML FORMAT
	 *
	 * @param String $filename The DOCX file name
	 * @return String With HTML code
	 */
	public function readDocument($filename)
	{
		$this->file = $filename;
		$this->readZipPart($filename);
		$reader = new \XMLREADER();
		$reader->XML($this->doc_xml->saveXML());

		$text = ''; $list_format="";

		$formatting['header'] = 0;
		// loop through docx xml dom
		while ($reader->read()) {
		// look for new paragraphs
			$paragraph = new \XMLREADER;
			$p = $reader->readOuterXML();

			if ($reader->nodeType == \XMLREADER::ELEMENT && $reader->name === 'w:p') {
				// set up new instance of \XMLREADER for parsing paragraph independantly
				$paragraph->xml($p);

				preg_match('/<w:pStyle w:val="(Heading.*?[1-6])"/',$p,$matches);
				if(isset($matches[1])) {
					switch($matches[1]){
						case 'Heading1': $formatting['header'] = 1; break;
						case 'Heading2': $formatting['header'] = 2; break;
						case 'Heading3': $formatting['header'] = 3; break;
						case 'Heading4': $formatting['header'] = 4; break;
						case 'Heading5': $formatting['header'] = 5; break;
						case 'Heading6': $formatting['header'] = 6; break;
						default: $formatting['header'] = 0; break;
					}
				}
				// open h-tag or paragraph
				$text .= ($formatting['header'] > 0) ? '<h'.$formatting['header'].'>' : '<p>';

				// loop through paragraph dom
				while ($paragraph->read()) {
					// look for elements
					if ($paragraph->nodeType == \XMLREADER::ELEMENT && $paragraph->name === 'w:r') {
						if($list_format == "")
							$text .= $this->checkFormating($paragraph);
						else {
							$text .= $list_format['open'];
							$text .= $this->checkFormating($paragraph);
							$text .= $list_format['close'];
						}
						$list_format ="";
						$paragraph->next();
					}
					else if($paragraph->nodeType == \XMLREADER::ELEMENT && $paragraph->name === 'w:pPr') { //lists
						$list_format = $this->getListFormating($paragraph);
						$paragraph->next();
					}
					else if($paragraph->nodeType == \XMLREADER::ELEMENT && $paragraph->name === 'w:drawing') { //images
						$text .= $this->checkImageFormating($paragraph);
						$paragraph->next();
					}
					else if ($paragraph->nodeType == \XMLREADER::ELEMENT && $paragraph->name === 'w:hyperlink') {
						$hyperlink = $this->getHyperlink($paragraph);
						$text .= $hyperlink['open'];
						$text .= $this->checkFormating($paragraph);
						$text .= $hyperlink['close'];
						$paragraph->next();
					}
				}
				$text .= ($formatting['header'] > 0) ? '</h'.$formatting['header'].'>' : '</p>';
			}
			else if ($reader->nodeType == \XMLREADER::ELEMENT && $reader->name === 'w:tbl') { //tables
				$paragraph->xml($p);
				$text .= $this->checkTableFormating($paragraph);
				$reader->next();
			}
		}
		$reader->close();
		if($this->debug) {
			echo "<div style='width:100%; height: 200px;'>";
			echo mb_convert_encoding($text, $this->encoding);
			echo "</div>";
		}
		return mb_convert_encoding($text, $this->encoding);
	}

	public function ommltomathml(&$xml)
	{
		$node = trim($xml->readOuterXML());
		libxml_disable_entity_loader(false);
		ini_set("display_errors", "1");
		error_reporting(E_ALL);
		$str = '<?xml version="1.0" encoding="utf-8"?><m:oMathPara xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math" xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main">'.$node.'</m:oMathPara>';
		$str  = str_replace('w:', 'a:', $str);
		// echo "OMML:<br>";
		// print_r($str);
		// echo "";

		$omml = new \DOMDocument;
		$omml->loadXML($str);

		$xsl = new \DOMDocument;
		$xsl->substituteEntities = TRUE;

		$xsl->load(\Yii::getAlias('@app').'/web/omml2mml.xsl'); // This could be found in MSOffice installation
		$processor = new \XSLTProcessor;
		$processor->importStyleSheet($xsl);
		$mml = '<math xmlns="http://www.w3.org/1998/Math/MathML" display="inline">'.$processor->transformToXML($omml).'</math>';
		return $mml;
	}

	public function isCorrectTest($array)
	{
		return count($array) == 5;
	}
	public function generate($array)
	{
		$test = [];
		$test['title'] = $array[0];
		$numbers = range(1, 4);
		shuffle($numbers);
		$answerList = [
			0 => 'a',
			1 => 'b',
			2 => 'c',
			3 => 'd',
		];
		foreach ($numbers as $key => $value) {
			$test[$answerList[$key]] = (rtrim($array[$value], ':'));
			if($value == 1){
				$test['answer'] = $key + 1;
			}
		}
		return $test;
	}

	public function generateTest($filename)
	{
		$tests = [];
		$this->readDocument($filename);
		foreach($this->arr as $el){
			if($this->isCorrectTest($el)){
				$test = $this->generate($el);
				array_push($tests, $test);
			}
		}
		return $tests;
	}
}
?>
