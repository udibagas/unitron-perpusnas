<?php 

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SMADING PERPUSNAS  </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
    <script src="js/nprogress.js"></script>
    <script>
        NProgress.start();
    </script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

        

            <!-- page content -->
            

                    
                        <div class="abcdefg">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Suhu</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
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
                                        <li><a href="#"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <script type="text/javascript">var timeTicket1;</script>
                                    <div id="main1" style="height:400px;"></div>

                                </div>
                            </div>
                        </div>

                     

              



    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>



    <!-- echart -->
    <script src="js/echart/echarts-all.js"></script>
    <script src="js/echart/green.js"></script>

    <script>
        


var myChart1 = echarts.init(document.getElementById('main1'));
    option1 = {
        tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    series : [
        {
            name:'SUHU #1',
            type:'gauge',
           min:0,
            max:40,
            splitNumber:5,     // 分割段数，默认为5
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: [[0.2, '#228b22'],[0.8, '#48b'],[1, '#ff4500']], 
                    width: 8
                }
            },
            axisTick: {            // 坐标轴小标记
                splitNumber: 10,   // 每份split细分多少段
                length :12,        // 属性length控制线长
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            axisLabel: {           // 坐标轴文本标签，详见axis.axisLabel
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    color: 'auto'
                }
            },
            splitLine: {           // 分隔线
                show: true,        // 默认显示，属性show控制显示与否
                length :30,         // 属性length控制线长
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
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
                formatter:'{value} C',
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    color: 'auto',
                    fontWeight: 'bolder'
                }
            },
            data:[{value: 50, name: 'SUHU #1'}]
        }
    ]
};

clearInterval(timeTicket1);
timeTicket1 = setInterval(function (){
    option1.series[0].data[0].value = (Math.random()*40).toFixed(0) - 0;
    myChart1.setOption(option1,true);
},2000);



var myChart2 = echarts.init(document.getElementById('main2'));
    option2 = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    series : [
        {
            name:'Listrik',
            type:'gauge',
            center : ['50%', '35%'], 
            radius : [0, '75%'],
            startAngle: 30,
            endAngle : -110,
            min: 0,                     
            max: 30,                 
            precision: 0,             
            splitNumber: 5,           
            axisLine: {           
                show: true,        
                lineStyle: {      
                    color: [[0.2, 'lightgreen'],[0.4, 'orange'],[0.8, 'skyblue'],[1, '#ff4500']], 
                    width: 30
                }
            },
            axisTick: {            
                show: true,        
                splitNumber: 4,   
                length :8,        
                lineStyle: {      
                    color: '#eee',
                    width: 1,
                    type: 'solid'
                }
            },
            axisLabel: {          
                show: true,
                
                textStyle: {       
                    color: '#333'
                }
            },
            splitLine: {           
                show: true,        
                length :30,         
                lineStyle: {       
                    color: '#eee',
                    width: 2,
                    type: 'solid'
                }
            },
            pointer : {
                length : '80%',
                width : 8,
                color : 'auto'
            },
            title : {
                show : true,
                offsetCenter: ['-65%', -10],      
                textStyle: {       
                    color: '#333',
                    fontSize : 15
                }
            },
            detail : {
                show : true,
                backgroundColor: 'rgba(0,0,0,0)',
                borderWidth: 0,
                borderColor: '#ccc',
                width: 100,
                height: 40,
                offsetCenter: ['-60%', 10],     
                formatter:'{value} KW',
                textStyle: {      
                    color: 'auto',
                    fontSize : 30
                }
            },
            data:[{value: 50, name: 'DAYA #1'}]
        }
    ]
};

clearInterval(timeTicket2);
timeTicket2 = setInterval(function (){
    option2.series[0].data[0].value = (Math.random()*40).toFixed(0) - 0;
    myChart2.setOption(option2,true);
},2000);



var myChart3 = echarts.init(document.getElementById('main3'));
    option3 = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    series : [
        {
            name:'SUHU #1',
            type:'gauge',
            min:0,
            max:500,
            center : ['50%', '35%'], 
            radius : [0, '75%'],
            startAngle: -90,
            endAngle : -180,
            splitNumber:4,     
            axisLine: {            
                lineStyle: {       
                    color: [[0.2, '#228b22'],[0.8, '#48b'],[1, '#ff4500']], 
                    width: 15
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
                length :20,         
                lineStyle: {       
                    color: 'auto'
                }
            },
            pointer : {
                width : 5
            },
            title : {
                show : true,
                textStyle: {       
                fontWeight: 'bolder',
            
                }
            },
            detail : {
                formatter:'{value} Volt',
                 show : true,
                backgroundColor: 'rgba(0,0,0,0)',
                offsetCenter: ['40%',10],
                textStyle: {       
                color: 'auto',
                fontWeight: 'bolder',
                fontSize : 30,
             
                }
            },
            data:[{value: 500, name: 'Voltage #1'}]
        }
    ]
};

clearInterval(timeTicket3);
timeTicket3 = setInterval(function (){
    option3.series[0].data[0].value = (Math.random()*500).toFixed(0) - 0;
    myChart3.setOption(option3,true);
},2000);

var myChart4 = echarts.init(document.getElementById('main4'));
    option4 = {
        tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    series : [
        {
            name:'SUHU #1',
            type:'gauge',
           min:0,
            max:80,
            splitNumber:5,     
            axisLine: {            
                lineStyle: {       
                    color: [[0.2, '#228b22'],[0.8, '#48b'],[1, '#ff4500']], 
                    width: 8
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
                length :30,       
                lineStyle: {       
                    color: 'auto'
                }
            },
            pointer : {
                width : 5
            },
            title : {
                show : true,
                offsetCenter: [0, '-40%'],      
                textStyle: {      
                    fontWeight: 'bolder'
                }
            },
            detail : {
                formatter:'{value} %',
                textStyle: {       
                    color: 'auto',
                    fontWeight: 'bolder'
                }
            },
            data:[{value: 50, name: 'Lembab #1'}]
        }
    ]
};

clearInterval(timeTicket4);
timeTicket4 = setInterval(function (){
    option4.series[0].data[0].value = (Math.random()*40).toFixed(0) - 0;
    myChart4.setOption(option4,true);
},2000);


var myChart5 = echarts.init(document.getElementById('main5'));
    option5 = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    series : [
        {
            name:'Frequensi',
            type:'gauge',
            center : ['50%', '50%'],    // 默认全局居中
            radius : [0, '75%'],
            startAngle: 140,
            endAngle : -140,
            min: 25,                     
            max: 75,                   // 最大值
            precision: 0,               // 小数精度，默认为0，无小数点
            splitNumber: 10,             // 分割段数，默认为5
            axisLine: {            // 坐标轴线
                show: true,        // 默认显示，属性show控制显示与否
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: [[0.2, '#ff4500'],[0.4, 'orange'],[0.60, 'green'],[0.8, 'orange'],[1, '#ff4500']], 
                    width: 30
                }
            },
            axisTick: {            // 坐标轴小标记
                show: true,        // 属性show控制显示与否，默认不显示
                splitNumber: 5,    // 每份split细分多少段
                length :8,         // 属性length控制线长
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: '#eee',
                    width: 1,
                    type: 'solid'
                }
            },
            splitLine: {           // 分隔线
                show: true,        // 默认显示，属性show控制显示与否
                length :30,         // 属性length控制线长
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                    color: '#eee',
                    width: 2,
                    type: 'solid'
                }
            },
            pointer : {
                length : '80%',
                width : 8,
                color : 'auto'
            },
            title : {
                show : true,
                offsetCenter: ['-65%', -10],       // x, y，单位px
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    color: '#333',
                    fontSize : 15
                }
            },
            detail : {
                show : true,
                backgroundColor: 'rgba(0,0,0,0)',
                borderWidth: 0,
                borderColor: '#ccc',
                width: 100,
                height: 40,
                offsetCenter: ['-60%', 10],       // x, y，单位px
                formatter:'{value} Hz',
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    color: 'auto',
                    fontSize : 30
                }
            },
            data:[{value: 50, name: 'Frequensi'}]
        }
    ]
};

clearInterval(timeTicket5);
timeTicket5 = setInterval(function (){
    option5.series[0].data[0].value = (Math.random()*40).toFixed(0) - 0;
    myChart5.setOption(option5,true);
},2000);


var myChart6 = echarts.init(document.getElementById('main6'));
    option6 = {
    tooltip : {
        formatter: "{a} <br/>{b} : {c}%"
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    series : [
        {
            name:'current',
            type:'gauge',
            center : ['50%', '40%'], 
            radius : [0, '80%'],
            startAngle: -80,
            endAngle : -200,
            min: 0,                     
            max: 400,                 
            precision: 0,             
            splitNumber: 5,           
            axisLine: {           
                show: true,        
                lineStyle: {      
                    color: [[0.2, 'lightgreen'],[0.4, 'orange'],[0.8, 'skyblue'],[1, '#ff4500']], 
                    width: 30
                }
            },
            axisTick: {            
                show: true,        
                splitNumber: 4,   
                length :8,        
                lineStyle: {      
                    color: '#eee',
                    width: 1,
                    type: 'solid'
                }
            },
            axisLabel: {          
                show: true,
                
                textStyle: {       
                    color: '#333'
                }
            },
            splitLine: {           
                show: true,        
                length :30,         
                lineStyle: {       
                    color: '#eee',
                    width: 2,
                    type: 'solid'
                }
            },
            pointer : {
                length : '80%',
                width : 8,
                color : 'auto'
            },
            title : {
                show : true,
                offsetCenter: ['50', -10],      
                textStyle: {       
                    color: '#333',
                    fontSize : 15
                }
            },
            detail : {
                show : true,
                backgroundColor: 'rgba(0,0,0,0)',
                borderWidth: 0,
                borderColor: '#ccc',
                width: 100,
                height: 40,
                offsetCenter: ['50%', 10],     
                formatter:'{value} A',
                textStyle: {      
                    color: 'auto',
                    fontSize : 30
                }
            },
            data:[{value: 50, name: 'Current #1'}]
        }
    ]
};

clearInterval(timeTicket6);
timeTicket6 = setInterval(function (){
    option6.series[0].data[0].value = (Math.random()*40).toFixed(0) - 0;
    myChart6.setOption(option6,true);
},2000);


var myChart7 = echarts.init(document.getElementById('main7'));
    option7 = {
    tooltip : {
        formatter: "{a} <br/>{c} {b}"
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    series : [
        {
            name:'Ikhtisar',
            type:'gauge',
            z: 3,
            min:0,
            max:40,
            splitNumber:4,
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    width: 10
                }
            },
            axisTick: {            // 坐标轴小标记
                length :15,        // 属性length控制线长
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: {           // 分隔线
                length :20,         // 属性length控制线长
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            title : {
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder',
                    fontSize: 20,
                    fontStyle: 'italic'
                }
            },
            detail : {
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder'
                }
            },
            data:[{value: 40, name: 'Suhu #1'}]
        },
        {
            name:'suhu1',
            type:'gauge',
            center : ['25%', '55%'],    // 默认全局居中
            radius : '50%',
            min:0,
            max:80,
            endAngle:45,
            splitNumber:4,
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    width: 8
                }
            },
            axisTick: {            // 坐标轴小标记
                length :12,        // 属性length控制线长
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            splitLine: {           // 分隔线
                length :20,         // 属性length控制线长
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            pointer: {
                width:5
            },
            title : {
                offsetCenter: [0, '-30%'],       // x, y，单位px
            },
            detail : {
                textStyle: {       // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                    fontWeight: 'bolder'
                }
            },
            data:[{value: 1.5, name: 'Lembab #1'}]
        },
        {
            name:'油表',
            type:'gauge',
            center : ['75%', '50%'],    // 默认全局居中
            radius : '50%',
            min:0,
            max:2,
            startAngle:135,
            endAngle:45,
            splitNumber:2,
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: [[0.2, '#228b22'],[0.8, '#48b'],[1, '#ff4500']], 
                    width: 8
                }
            },
            axisTick: {            // 坐标轴小标记
                splitNumber:5,
                length :10,        // 属性length控制线长
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: 'auto'
                }
            },
            axisLabel: {
                formatter:function(v){
                    switch (v + '') {
                        case '0' : return 'Normal';
                        case '1' : return 'Gas';
                        case '2' : return 'Alarm';
                    }
                }
            },
            splitLine: {           // 分隔线
                length :15,         // 属性length控制线长
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            pointer: {
                width:2
            },
            title : {
                show: false
            },
            detail : {
                show: false
            },
            data:[{value: 0.5, name: 'gas'}]
        },
        {
            name:'水表',
            type:'gauge',
            center : ['75%', '50%'],    // 默认全局居中
            radius : '50%',
            min:0,
            max:2,
            startAngle:315,
            endAngle:225,
            splitNumber:2,
            axisLine: {            // 坐标轴线
                lineStyle: {       // 属性lineStyle控制线条样式
                    color: [[0.2, '#228b22'],[0.8, '#48b'],[1, '#ff4500']], 
                    width: 8
                }
            },
            axisTick: {            // 坐标轴小标记
                show: false
            },
            axisLabel: {
                formatter:function(v){
                    switch (v + '') {
                        case '0' : return 'Normal';
                        case '1' : return 'Water';
                        case '2' : return 'Alarm';
                    }
                }
            },
            splitLine: {           // 分隔线
                length :15,         // 属性length控制线长
                lineStyle: {       // 属性lineStyle（详见lineStyle）控制线条样式
                    color: 'auto'
                }
            },
            pointer: {
                width:2
            },
            title : {
                show: false
            },
            detail : {
                show: false
            },
            data:[{value: 0.5, name: 'gas'}]
        }
    ]
};

clearInterval(timeTicket7);
timeTicket7 = setInterval(function (){
    option7.series[0].data[0].value = (Math.random()*40).toFixed(2) - 0;
    option7.series[1].data[0].value = (Math.random()*80).toFixed(2) - 0;
    option7.series[2].data[0].value = (Math.random()*0).toFixed(2) - 0;
    option7.series[3].data[0].value = (Math.random()*0).toFixed(2) - 0;
    myChart7.setOption(option7,true);
},2000);


        
    </script>
</body>

</html>