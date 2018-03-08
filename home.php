<?php 

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

?>

                <div class="row">
                    <div class="abcdefg">
                        <div class="dashboard_graph">

                            <div class="row panel-heading">
                                <div class="col-md-6">
                                    <h3>Tren Keseluruhan<small> Suhu,Lembab,Daya</small></h3>
                                </div>
                                <div class="col-md-6">
                                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                        <span>03-Feb-2016</span> <b class="caret"></b>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div id="placeholder33" style="height: 260px; display: none" class="demo-placeholder"></div>
                                <div style="width: 100%;">
                                    <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                                <div class="panel-heading">
                                    <h2>Tren</h2>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-6">
                                    <div>
                                        <p>Suhu</p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <p>Lembab</p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-6">
                                    <div>
                                        <p>Daya</p>
                                        <div class="">
                                            <div class="progress progress_sm" style="width: 76%;">
                                                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
                <br />

                <div class="row">


                    <div class="abcdefg">
                        <div class="panel panel-success tile fixed_height_320">
                            <div class="panel-heading">
                                <h2>Ikhtisar Suhu</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                               
    <?php 
    for($a=1;$a<=2;$a++){
?>
  <script type="text/javascript">var timeTicket<?php echo $a; ?>;</script>
<div id="main<?php echo $a; ?>" style="height:200px;border:1px solid #ccc;"></div>

    <script type="text/javascript">
    var myChart<?php echo $a; ?> = echarts.init(document.getElementById('main<?php echo $a; ?>'));
       option<?php echo $a; ?> = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    series : [
        {
            name:'Meteran',
            type:'gauge',
            splitNumber: 5,      
            axisLine: {           
                lineStyle: {       
                    color: [[0.2, '#228b22'],[0.8, '#48b'],[1, '#ff4500']], 
                    width: 4
                }
            },
            axisTick: {            
                splitNumber: 10,   
                length :12,        
                lineStyle: {       
                    color: 'auto'
                }
            },
            axisLabel: {           
                textStyle: {       
                    color: 'auto'
                }
            },
            splitLine: {         
                show: true,      
                length :15,         
                lineStyle: {       
                    color: 'auto'
                }
            },
            pointer : {
                width : 5
            },
            title : {
                show : true,
                offsetCenter: [0, '-40%'],       // x, y，单位px
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder'
                }
            },
            detail : {
                formatter:'{value}',
                textStyle: {    
                    color: 'auto'
                }
            },
            data:[{value: 50, name: 'C'}]
        }
    ]
};

clearInterval(timeTicket<?php echo $a; ?>);
timeTicket<?php echo $a; ?> = setInterval(function (){
    option<?php echo $a; ?>.series[0].data[0].value = (Math.random()*100).toFixed(0) - 0;
    myChart<?php echo $a; ?>.setOption(option<?php echo $a; ?>,true);
},2000);


    </script>

    <?php } ?>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-success tile fixed_height_320 overflow_hidden">
                            <div class="panel-heading">
                                <h2>Device Usage</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">

                                <table class="" style="width:100%">
                                    <tr>
                                        <th style="width:37%;">
                                            <p>Top 5</p>
                                        </th>
                                        <th>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <p class="">Device</p>
                                            </div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <p class="">Progress</p>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <canvas id="canvas1" height="140" width="140" style="margin: 15px 10px 10px 0"></canvas>
                                        </td>
                                        <td>
                                            <table class="tile_info">
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square blue"></i>IOS </p>
                                                    </td>
                                                    <td>40%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square green"></i>Android </p>
                                                    </td>
                                                    <td>10%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square purple"></i>Blackberry </p>
                                                    </td>
                                                    <td>20%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square aero"></i>Symbian </p>
                                                    </td>
                                                    <td>15%</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p><i class="fa fa-square red"></i>Others </p>
                                                    </td>
                                                    <td>30%</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-success tile fixed_height_320">
                            <div class="panel-heading">
                                <h2>Quick Settings</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="dashboard-widget-content">
                                    <ul class="quick-list">
                                        <li><i class="fa fa-calendar-o"></i><a href="#">Settings</a>
                                        </li>
                                        <li><i class="fa fa-bars"></i><a href="#">Subscription</a>
                                        </li>
                                        <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                                        <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                                        </li>
                                        <li><i class="fa fa-bar-chart"></i><a href="#">Auto Renewal</a> </li>
                                        <li><i class="fa fa-line-chart"></i><a href="#">Achievements</a>
                                        </li>
                                        <li><i class="fa fa-area-chart"></i><a href="#">Logout</a>
                                        </li>
                                    </ul>

                                    <div class="sidebar-widget">
                                        <h4>Profile Completion</h4>
                                        <canvas width="150" height="80" id="foo" class="" style="width: 160px; height: 100px;"></canvas>
                                        <div class="goal-wrapper">
                                            <span class="gauge-value pull-left">$</span>
                                            <span id="gauge-text" class="gauge-value pull-left">$100</span>
                                            <span id="goal-text" class="goal-value pull-right">$5,000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h2>Recent Activities <small>Sessions</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="dashboard-widget-content">

                                    <ul class="list-unstyled timeline widget">
                                        <li>
                                            <div class="block">
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


                    <div class="col-md-8 col-sm-8 col-xs-12">



                        <div class="row">

                            <div class="abcdefg">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h2>Visitors location <small>geo-presentation</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Settings 1</a>
                                                    </li>
                                                    <li><a href="#">Settings 2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="dashboard-widget-content">
                                            <div class="col-md-4 hidden-small">
                                                <h2 class="line_30">125.7k Views from 60 countries</h2>

                                                <table class="countries_list">
                                                    <tbody>
                                                        <tr>
                                                            <td>United States</td>
                                                            <td class="fs15 fw700 text-right">33%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>France</td>
                                                            <td class="fs15 fw700 text-right">27%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Germany</td>
                                                            <td class="fs15 fw700 text-right">16%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Spain</td>
                                                            <td class="fs15 fw700 text-right">11%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Britain</td>
                                                            <td class="fs15 fw700 text-right">10%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="world-map-gdp" class="col-md-8 col-sm-12 col-xs-12" style="height:230px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">


                            <!-- Start to do list -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h2>To Do List <small>Sample tasks</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Settings 1</a>
                                                    </li>
                                                    <li><a href="#">Settings 2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">

                                        <div class="">
                                            <ul class="to_do">
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Schedule meeting with new client </p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Create email address for new intern</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Food truck fixie locavors mcsweeney</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Create email address for new intern</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Have IT fix the network printer</p>
                                                </li>
                                                <li>
                                                    <p>
                                                        <input type="checkbox" class="flat"> Copy backups to offsite location</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End to do list -->


                            <!-- start of weather widget -->
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h2>Daily active users <small>Sessions</small></h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Settings 1</a>
                                                    </li>
                                                    <li><a href="#">Settings 2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="temperature"><b>Monday</b>, 07:30 AM
                                                    <span>F</span>
                                                    <span><b>C</b>
                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="weather-icon">
                                                    <span>
                                            <canvas height="84" width="84" id="partly-cloudy-day"></canvas>
                                        </span>

                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="weather-text">
                                                    <h2>Texas
                                            <br><i>Partly Cloudy Day</i>
                                        </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="weather-text pull-right">
                                                <h3 class="degrees">23</h3>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>


                                        <div class="row weather-days">
                                            <div class="col-sm-2">
                                                <div class="daily-weather">
                                                    <h2 class="day">Mon</h2>
                                                    <h3 class="degrees">25</h3>
                                                    <span>
                                                <canvas id="clear-day" width="32" height="32">
                                                </canvas>

                                        </span>
                                                    <h5>15
                                            <i>km/h</i>
                                        </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="daily-weather">
                                                    <h2 class="day">Tue</h2>
                                                    <h3 class="degrees">25</h3>
                                                    <canvas height="32" width="32" id="rain"></canvas>
                                                    <h5>12
                                            <i>km/h</i>
                                        </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="daily-weather">
                                                    <h2 class="day">Wed</h2>
                                                    <h3 class="degrees">27</h3>
                                                    <canvas height="32" width="32" id="snow"></canvas>
                                                    <h5>14
                                            <i>km/h</i>
                                        </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="daily-weather">
                                                    <h2 class="day">Thu</h2>
                                                    <h3 class="degrees">28</h3>
                                                    <canvas height="32" width="32" id="sleet"></canvas>
                                                    <h5>15
                                            <i>km/h</i>
                                        </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="daily-weather">
                                                    <h2 class="day">Fri</h2>
                                                    <h3 class="degrees">28</h3>
                                                    <canvas height="32" width="32" id="wind"></canvas>
                                                    <h5>11
                                            <i>km/h</i>
                                        </h5>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="daily-weather">
                                                    <h2 class="day">Sat</h2>
                                                    <h3 class="degrees">26</h3>
                                                    <canvas height="32" width="32" id="cloudy"></canvas>
                                                    <h5>10
                                            <i>km/h</i>
                                        </h5>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end of weather widget -->
                        </div>

                    </div>

                </div>
