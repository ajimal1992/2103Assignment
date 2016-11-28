var options = {
    series: {
        lines: {
            show: true
        },
        points: {
            show: true
        }
    },
    grid: {
        hoverable: true //IMPORTANT! this is needed for tooltip to work
    },
    xaxis:{
        tickDecimals: 0
    },
    tooltip: true,
    tooltipOpts: {
        content: "%s Birth year:%x, Total Births:%y"
    }
};

var sqlType = "sql";

var plotObj;

$(document).ready(function () {
    reset();
    $('.dropdown-menu a').click(function(){
        $('#sortBy').text($(this).text());
        fillOptionValues($(this).text());
    });
});

function fillOptionValues(option){
    var tablename = "";
    if(option==="Total Infants"){
        $('.filter').hide();
        tablename = "infants";
    }
    else if(option==="Total births by Mother's race"){
        $('.filter').show();
        tablename = "Mother_births_by";
        var columnname = "race";
    }
    else if(option==="Total births by Mother's child gender"){
        $('.filter').show();
        tablename = "Mother_births_by";
        var columnname = "child_gender";
    }
    else if(option==="Total births by Mother's age group"){
        $('.filter').show();
        tablename = "Mother_births_by";
        var columnname = "age_group";
    }
    else if(option==="Total births by Fathers's race"){
        $('.filter').show();
        tablename = "Father_births_by";
        var columnname = "race";
    }
    else if(option==="Total births by Fathers's child gender"){
        $('.filter').show();
        tablename = "Father_births_by";
        var columnname = "child_gender";
    }
    
    if(option!=="Total Infants"){
        $.ajax({                                      
           url: 'queryPopulationStatsSQL.php',                         
           data: "type=distinctColumn&table=" + tablename + "&column=" + columnname,                
           dataType: 'json',                //data format      
           success: function(data)          //on recieve of reply
           {
               $('#filterBy').empty();
               for (var i = 0, len = data.length; i < len; i++){
                   $("#filterBy").append('<option value=' + data[i][0] + '>' + data[i][0] + '</option>')
               }
           } 
        });        
    }
    $.ajax({                                      
      url: 'queryPopulationStatsSQL.php',                         
      data: "type=distinctYears&table=" + tablename,                
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
          $('#maxYear').empty();
          $('#minYear').empty();
          for (var i = 0, len = data.length; i < len; i++){
              $("#maxYear").append('<option value=' + data[i][0] + '>' + data[i][0] + '</option>')
              $("#minYear").append('<option value=' + data[i][0] + '>' + data[i][0] + '</option>')
          }
      } 
    });
}

// Flot Charts sample data for SB Admin template

// Flot Line Chart with Tooltips
//$(document).ready(function () {
//    console.log("document ready");
//    var offset = 0;
//    plot();
//
//    function plot() {
//        var sin = [],
//                cos = [];
//        for (var i = 0; i < 12; i += 0.2) {
//            sin.push([i, Math.sin(i + offset)]);
//            cos.push([i, Math.cos(i + offset)]);
//        }
//
//        var options = {
//            series: {
//                lines: {
//                    show: true
//                },
//                points: {
//                    show: true
//                }
//            },
//            grid: {
//                hoverable: true //IMPORTANT! this is needed for tooltip to work
//            },
//            yaxis: {
//                min: -1.2,
//                max: 1.2
//            },
//            tooltip: true,
//            tooltipOpts: {
//                content: "'%s' of %x.1 is %y.4",
//                shifts: {
//                    x: -60,
//                    y: 25
//                }
//            }
//        };
//
//        var plotObj = $.plot($("#flot-line-chart"), [{
//                data: sin,
//                label: "sin(x)"
//            }, {
//                data: cos,
//                label: "cos(x)"
//            }],
//                options);  
//        plotObj.setupGrid();
//        plotObj.draw();
//    }
//});

function plot2(){
        var sin = [],
                cos = [];
        for (var i = 50; i < 1000; i += 20) {
            sin.push([i, i*10]);
            cos.push([i, i*5]);
        }

//        alert(sin[1]);

        var plotObj = $.plot($("#flot-line-chart"), [{
                data: sin,
                label: "X"
            }, {
                data: cos,
                label: "Y"
            }],
                options);  
        plotObj.setupGrid();
        plotObj.draw();
}

function reset(){
        plotObj = $.plot($("#flot-line-chart"), [],
                options);  
        plotObj.setupGrid();
        plotObj.draw();
}

function addInfants(){
    
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
    var min = $( "#minYear" ).val();
    var max = $( "#maxYear" ).val();
    $.ajax({                                      
      url: 'queryPopulationStatsSQL.php',                  //the script to call to get data          
      data: "type=infants&min=" + min + "&max=" + max,                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
          addData("Total infants", data)
      } 
    });
}

function addYearlyStatistics(labelName, tableName, colName){
    var min = $( "#minYear" ).val();
    var max = $( "#maxYear" ).val();   
//    alert(min+ " " + max);
    var labelHelp = $("#filterBy option:selected").map(function(){ return this.text }).get().join(", ");
//    alert(labelHelp);
    var whereQuery = $("#filterBy option:selected").map(function(){ return this.text}).get().join("' OR " + colName + "='");
    var whereQuery = colName + "='" + whereQuery + "'";
//    alert(whereQuery);
    if(whereQuery==="race=''"){
        return; //trying to be funny..
    }
//    alert("hit1");
    $.ajax({                                      
      url: 'queryPopulationStatsSQL.php',                  //the script to call to get data          
      data: "type=yearlyStats&min=" + min + "&max=" + max + "&where=" + whereQuery + "&tableName=" + tableName,                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
//          
//          alert("hit2");
          addData(labelName + " by " + labelHelp, data)
      },
      error: function(ts) { alert(ts.responseText)}
    });   
}

function addMotherBirthsBy(){
    var min = $( "#minYear" ).val();
    var max = $( "#maxYear" ).val();   
    var labelHelp = $("#filterBy option:selected").map(function(){ return this.value }).get().join(", ");
    var whereQuery = $("#filterBy option:selected").map(function(){ return this.value }).get().join("' OR race='");
    var whereQuery = "race='" + whereQuery + "'";
    if(whereQuery==="race=''"){
        return; //trying to be funny..
    }
//    alert("hit1");
    $.ajax({                                      
      url: 'queryPopulationStatsSQL.php',                  //the script to call to get data          
      data: "type=motherBirthsBy&min=" + min + "&max=" + max + "&where=" + whereQuery,                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
//          
//          alert("hit2");
          addData("Mother Births by " + labelHelp, data)
      },
      error: function(ts) { alert(ts.responseText)}
    });   
}

function addData(LABEL, DATA){
        var allData = plotObj.getData();
        var extractData = [];
        for (var i = 0, len = allData.length; i < len; i++) {
            extractData.push({data: allData[i].data, label: allData[i].label});
        }
        extractData.push({data: DATA, label: LABEL});
        plotObj = $.plot($("#flot-line-chart"), 
                        extractData,
                        options);
        plotObj.setupGrid();
        plotObj.draw();
}


function add(){
    var option = $('#sortBy').text();
    if(option === 'Total Infants'){
        addInfants();
    }
    else if(option==="Total births by Mother's race"){
        addYearlyStatistics("Mother's births by race: ", "Mother_births_by", "race");
    }
    else if(option==="Total births by Mother's child gender"){
        addYearlyStatistics("Mother's births by child gender: ", "Mother_births_by", "child_gender");
    }
    else if(option==="Total births by Mother's age group"){
        addYearlyStatistics("Mother's births by age group: ", "Mother_births_by", " age_group");
    }
    else if(option==="Total births by Fathers's race"){
        addYearlyStatistics("Mother's births by race: ", "Father_births_by", "race");
    }
    else if(option==="Total births by Fathers's child gender"){
        addYearlyStatistics("Mother's births by child gender: ", "Father_births_by", "child_gender");
    }
}