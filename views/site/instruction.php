<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Yo\'riqnoma';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
            <h2>Yo'riqnoma</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <div class="col-md-12 col-sm-12 ">

                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                    <!-- start recent activity -->
                    <table class="data table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Client Company</th>
                            <th class="hidden-phone">Hours Spent</th>
                            <th>Contribution</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>New Company Takeover Review</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">18</td>
                            <td class="vertical-align-mid">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>New Partner Contracts Consultanci</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">13</td>
                            <td class="vertical-align-mid">
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Partners and Inverstors report</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">30</td>
                            <td class="vertical-align-mid">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>New Company Takeover Review</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">28</td>
                            <td class="vertical-align-mid">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                            </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- end recent activity -->

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                    <!-- start user projects -->
                    <table class="data table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Project Name</th>
                            <th>Client Company</th>
                            <th class="hidden-phone">Hours Spent</th>
                            <th>Contribution</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>New Company Takeover Review</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">18</td>
                            <td class="vertical-align-mid">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>New Partner Contracts Consultanci</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">13</td>
                            <td class="vertical-align-mid">
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Partners and Inverstors report</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">30</td>
                            <td class="vertical-align-mid">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>New Company Takeover Review</td>
                            <td>Deveint Inc</td>
                            <td class="hidden-phone">28</td>
                            <td class="vertical-align-mid">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                            </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- end user projects -->

                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                    <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                        photo booth letterpress, commodo enim craft beer mlkshk </p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
        <div class="x_title">
            <h2>Ko'rsatmalar</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <ul class="list-unstyled timeline">
            <li>
                <div class="block">
                <div class="tags">
                    <a href="" class="tag">
                    <span>Entertainment</span>
                    </a>
                </div>
                <div class="block_content">
                    <h2 class="title">
                                    <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                </h2>
                    <div class="byline">
                    <span>13 hours ago</span> by <a>Jane Smith</a>
                    </div>
                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                    </p>
                </div>
                </div>
            </li>
            <li>
                <div class="block">
                <div class="tags">
                    <a href="" class="tag">
                    <span>Entertainment</span>
                    </a>
                </div>
                <div class="block_content">
                    <h2 class="title">
                                    <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                </h2>
                    <div class="byline">
                    <span>13 hours ago</span> by <a>Jane Smith</a>
                    </div>
                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                    </p>
                </div>
                </div>
            </li>
            </ul>

        </div>
        </div>
    </div>
    </div>
    
</div>
