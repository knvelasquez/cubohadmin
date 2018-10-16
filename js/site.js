const savedQueryName = 'revenuetodayxx';
function createNewSavedQuery(){
  console.log('create new saved query');
  client
    .put(client.url('queries', 'saved', savedQueryName))
    .auth(client.masterKey())
    .send({
      query: {
        analysis_type: 'sum',
        event_collection: 'orders',
        target_property: 'revenue',
        timeframe: "this_1_days",
        filters: [
          {
            operator: 'eq',
            property_name: 'user',
            property_value: 'id'
          }
        ],
        refresh_rate: 14400
      },
      metadata: {
        display_name: 'Revenue (Today)',
        visualization: {
          chart_type: 'metric'
        }
      }
    })
	.then(function(res) {
		console.log('created...', res);
		return getResult();
     })
	  .catch(function(err) {
       console.log(err);
     });
    /*.then(res => {
      console.log('created...', res);
      return getResult();
    })
    .catch(err => {
      console.log(err);
    });*/
}
function getResult(){
  console.log('run getResult');
  return client
    .query('saved', savedQueryName)   	
	.then(function(res) {
		console.log('got result', res);
		// create a keenDataviz instance
		const revenuetodayDataviz = new KeenDataviz({
			container: '#revenuetoday',
			type: 'metric',
			prefix: '$'
		});
		// pass the response into the KeenDataviz instance
		revenuetodayDataviz.render(res);
     })
	 .catch(function(err) {
		if (err && !err.ok && err.error_code === 'ResourceNotFoundError') {
			// saved query doesn't exist yet - create a new one
			console.log('saved query not found', err);
			return createNewSavedQuery();
		}
		// other errors
		console.log(err);
     });
	/*.then(res => {
      console.log('got result', res);

      // create a keenDataviz instance
      const revenuetodayDataviz = new KeenDataviz({
        container: '#revenuetoday',
        type: 'metric',
        prefix: '$'
      });
      // pass the response into the KeenDataviz instance
      revenuetodayDataviz.render(res);

    })
    .catch(err => {
      if (err && !err.ok && err.error_code === 'ResourceNotFoundError') {
        // saved query doesn't exist yet - create a new one
        console.log('saved query not found', err);
        return createNewSavedQuery();
      }
      // other errors
      console.log(err);
    });*/
}
//getResult();
//month range picker js
var MONTHS = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
$(function () {
  startMonth = 7;
  startYear = 2014
  SingleMonth = true
  endMonth = 8;
  endYear = 2015;
  fiscalMonth = 7;
  if(startMonth < 10)
  	startDate = parseInt("" + startYear + '0' + startMonth + "");
  else
    startDate = parseInt("" + startYear  + startMonth + "");
  if(endMonth < 10)
  	endDate = parseInt("" + endYear + '0' + endMonth + "");
  else
    endDate = parseInt("" + endYear + endMonth + "");
  content = '<div class="row mpr-calendarholder">';
  calendarCount = endYear - startYear;
  if(calendarCount == 0)
    calendarCount++;
  var d = new Date();
  for(y = 0; y < 2; y++){
		content += '<div class="col-xs-6" ><div class="mpr-calendar row" id="mpr-calendar-' + (y+1) + '">'
 						 + '<h5 class="col-xs-12"><i class="mpr-yeardown fa fa-chevron-circle-left"></i><span>' + (startYear + y).toString() + '</span><i class="mpr-yearup fa fa-chevron-circle-right"></i></h5><div class="mpr-monthsContainer"><div class="mpr-MonthsWrapper">';
    for(m=0; m < 12; m++){
      var monthval;
      if((m+1) < 10)
        monthval = "0" + (m+1);
      else
        monthval = "" + (m+1);
			content += '<span data-month="' + monthval  + '" class="col-xs-3 mpr-month">' + MONTHS[m] + '</span>';
    }
    content += '</div></div></div></div>';
  }
  content += '<div class="col-xs-1"> <h5 class="mpr-quickset">Presets</h5>';
  content += '<button class="btn btn-info mpr-fiscal-ytd">Today</button>';
  content += '<button class="btn btn-info mpr-ytd">This week</button>';
  content += '<button class="btn btn-info mpr-prev-fiscal">This month</button>';
  content += '<button class="btn btn-info mpr-prev-year">All-Time</button>';
  content += '</div>';
  content += '</div>';
  $(document).on('click','.mpr-month',function(e){
    e.stopPropagation();
  		$month = $(this);
    	var monthnum = $month.data('month');
    	var year = $month.parents('.mpr-calendar').children('h5').children('span').html();
        if($month.parents('#mpr-calendar-1').size() > 0){
          //Start Date
          startDate = parseInt("" + year + monthnum);
          if(startDate > endDate){

            if(year != parseInt(endDate/100))
              $('.mpr-calendar:last h5 span').html(year);
               endDate = startDate;
          }
        }else{
          //End Date
          endDate = parseInt("" + year + monthnum);
          if(startDate > endDate){
            if(year != parseInt(startDate/100))
              $('.mpr-calendar:first h5 span').html(year);
            startDate = endDate;
          }
        }		
    	paintMonths();
  });
  $(document).on('click','.mpr-yearup',function(e){
    	e.stopPropagation();
  		var year = parseInt($(this).prev().html());
    	year++;
    	$(this).prev().html(""+year);
   	 	$(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
      });
  });
  $(document).on('click','.mpr-yeardown',function(e){
    	e.stopPropagation();
  		var year = parseInt($(this).next().html());
    	year--;
    	$(this).next().html(""+year);
   	 	//paintMonths();
      $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
      });
  });
  $(document).on('click','.mpr-ytd', function(e){
    e.stopPropagation();
    var d = new Date();
    startDate = parseInt(d.getFullYear() + "01");
    var month = d.getMonth() + 1;
    if(month < 9)
      month = "0" + month;
    endDate = parseInt("" + d.getFullYear() + month);
    $('.mpr-calendar').each(function(){
      var $cal = $(this);
      var year = $('h5 span',$cal).html(d.getFullYear());
    });
    $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
    });
  });
  $(document).on('click','.mpr-prev-year', function(e){
    e.stopPropagation();
    var d = new Date();
    var year = d.getFullYear()-1;
    startDate = parseInt(year + "01");
    endDate = parseInt(year + "12");
    $('.mpr-calendar').each(function(){
      var $cal = $(this);
      $('h5 span',$cal).html(year);
    });
    $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
    });
  });
  $(document).on('click','.mpr-fiscal-ytd', function(e){
    e.stopPropagation();
    var d = new Date();
    var year;
    if((d.getMonth()+1) < fiscalMonth)
      year = d.getFullYear() - 1;
    else
      year = d.getFullYear();
    if(fiscalMonth < 10)
      fm = "0" + fiscalMonth;
    else
      fm = fiscalMonth;
    if(d.getMonth()+1 < 10)
      cm = "0" + (d.getMonth()+1);
    else
      cm = (d.getMonth()+1);
    startDate = parseInt("" + year + fm);
    endDate = parseInt("" + d.getFullYear() + cm);
    $('.mpr-calendar').each(function(i){
      var $cal = $(this);
      if(i == 0)
      	$('h5 span',$cal).html(year);
      else
        $('h5 span',$cal).html(d.getFullYear());
    });
    $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
    });
  });
  $(document).on('click','.mpr-prev-fiscal', function(){
    var d = new Date();
    var year;
    if((d.getMonth()+1) < fiscalMonth)
      year = d.getFullYear() - 2;
    else
      year = d.getFullYear() - 1;
    if(fiscalMonth < 10)
      fm = "0" + fiscalMonth;
    else
      fm = fiscalMonth;
    if(fiscalMonth -1 < 10)
      efm = "0" + (fiscalMonth-1);
    else
      efm = (fiscalMonth-1);
    startDate = parseInt("" + year + fm);
    endDate = parseInt("" + (d.getFullYear() - 1) + efm);
    $('.mpr-calendar').each(function(i){
      var $cal = $(this);
      if(i == 0)
      	$('h5 span',$cal).html(year);
      else
        $('h5 span',$cal).html(d.getFullYear()-1);
    });
    $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
        paintMonths();
        $('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
    });
  });
  var mprVisible = false;
  var mprpopover = $('.mrp-container').popover({
    container: "body",
    placement: "bottom",
    html: true,
    content: content
  }).on('show.bs.popover', function () {
    $('.popover').remove();
    var waiter = setInterval(function(){
      if($('.popover').size() > 0){
        clearInterval(waiter);
        setViewToCurrentYears();
    		paintMonths();
      }
    },50);
  }).on('shown.bs.popover', function(){
    mprVisible = true;
  }).on('hidden.bs.popover', function(){
    mprVisible = false;
  });
  $(document).on('click','.mpr-calendarholder',function(e){
    e.preventDefault();
    e.stopPropagation();
  });
  $(document).on("click",".mrp-container",function(e){
    if(mprVisible){
      e.preventDefault();
    	e.stopPropagation();
      mprVisible = false;
    }
  });
  $(document).on("click",function(e){
    if(mprVisible){
    	$('.mpr-calendarholder').parents('.popover').fadeOut(200,function(){
        $('.mpr-calendarholder').parents('.popover').remove();
        $('.mrp-container').trigger('click');
      });
      mprVisible = false;
    }
  });
});
function setViewToCurrentYears(){
  	var startyear = parseInt(startDate / 100);
    var endyear = parseInt(endDate / 100);
  	$('.mpr-calendar h5 span').eq(0).html(startyear);
  	$('.mpr-calendar h5 span').eq(1).html(endyear);
}
function paintMonths(){
    $('.mpr-calendar').each(function(){
      var $cal = $(this);
      var year = $('h5 span',$cal).html();
      $('.mpr-month',$cal).each(function(i){
        if((i+1) > 9)
          cDate = parseInt("" + year + (i+1));
        else
          cDate = parseInt("" + year+ '0' + (i+1));
        if(cDate >= startDate && cDate <= endDate){
            $(this).addClass('mpr-selected');
        }else{
          $(this).removeClass('mpr-selected');
        }
      });
    });
  $('.mpr-calendar .mpr-month').css("background","");
    //Write Text
    var startyear = parseInt(startDate / 100);
    var startmonth = parseInt(safeRound((startDate / 100 - startyear)) * 100);
    var endyear = parseInt(endDate / 100);
    var endmonth = parseInt(safeRound((endDate / 100 - endyear)) * 100);
    $('.mrp-monthdisplay .mrp-lowerMonth').html(MONTHS[startmonth - 1] + " " + startyear);
    $('.mrp-monthdisplay .mrp-upperMonth').html(MONTHS[endmonth - 1] + " " + endyear);
    $('.mpr-lowerDate').val(startDate);
    $('.mpr-upperDate').val(endDate);
  	if(startyear == parseInt($('.mpr-calendar:first h5 span').html()))
  		$('.mpr-calendar:first .mpr-selected:first').css("background","#40667A");
    if(endyear == parseInt($('.mpr-calendar:last h5 span').html()))
      $('.mpr-calendar:last .mpr-selected:last').css("background","#40667A");
  }
  function safeRound(val){
    return Math.round(((val)+ 0.00001) * 100) / 100;
  }
  // end of month range picker
  // Add active class to the current button (highlight it)
//  var header = document.getElementById("myDIV");
//  var buttons = header.getElementsByClassName("button");
//  for (var i = 0; i < buttons.length; i++) {
//    buttons[i].addEventListener("click", function() {
//      var current = document.getElementsByClassName("active");
//      current[0].className = current[0].className.replace(" active", "");
//      this.className += " active";
//    });
//  }
  $('button').on('click', function(){
    $('button').removeClass('selected');
    $(this).addClass('selected');
  });