
App = Ember.Application.create({
	LOG_TRANSITIONS: true
});

/* ===========================

##Routes

=============================*/

App.Router.map(function() {
	this.route('index', { path: '/' });
	this.resource('portfolio', function(){
		this.route('artwork', {path: '/artwork'});
		this.route('webwork', {path: '/webWork'});
	
	});
	this.route('info')
});

App.IndexView = Ember.View.extend({
didInsertElement: function(){ 
	$('img').bind("contextmenu",function(e){  
        return false;  
})
}
});


/* ===========================

##port

=============================*/


App.PortfolioIndexView = Ember.View.extend({
	templateName: 'portfolioStart',
});

App.PortfolioWebworkView = Ember.View.extend({
	templateName: 'portfolioWebwork',
});


App.PortfolioIndexRoute = Ember.Route.extend({
  renderTemplate: function() {
 	this.render({outlet:'portfolio'});
  }
});

App.PortfolioWebworkRoute = Ember.Route.extend({
  renderTemplate: function() {
  	 this.render({outlet: 'portfolio'});
  },
 
  
});

App.PortfolioArtworkRoute = Ember.Route.extend({
  renderTemplate: function() {
    this.render({outlet: 'portfolio'});
  }
});


/*======================================================
======================================================

art work

======================================================
======================================================*/



App.PortfolioArtworkController = Ember.ArrayController.extend({
	imageSlides:[
		{
			url:"images/distance/086-2.jpg"
		},
		{
			url:"images/distance/_DSC6388-2.jpg"
		},
		{
			url:"images/distance/65.jpg"
		},
		{
			url:"images/distance/circle_R4.jpg"
		}		
	
	]
});


App.PortfolioArtworkView = Ember.View.extend({
templateName: 'portfolioArtwork',
isvisible: true,	
classNames: ['artwork'],
didInsertElement: function(){ 

	var portfolio = $('.mainImg');
	var activeImg = $('.mainImg img:first');
	var thumbImg = $('.thumbs img');
	var thumbact = $('.thumbs img:first');
	var portImg = $('.mainImg img');
	var	maxImage = portImg.length - 1;
	var i;
	var timer;
	var x;
	var ftawe = $('i')

	//intalize
		activeImg.addClass('active');
		thumbact.addClass('thumbact');
		i = 0;

	//timer
/*timer = setInterval(function(){
	
		if(i < maxImage){
			i++
			
			}else{
				i = 0
			}
ftawe.addClass('icon-play-circle')
portImg.removeClass('active');
thumbImg.removeClass('thumbact');

portImg.eq(i).addClass('active');
thumbImg.eq(i).addClass('thumbact');},400)
*/
thumbImg.click(function(){

	if(thumbImg !== $(this)){
		thumbImg.removeClass('thumbact')
		portImg.removeClass('active')
	};

	$(this).addClass('thumbact');

	x = $(this).index('img') - 4;

	portImg.eq(x).addClass('active')

	
})
/*
thumbImg.hover(function(){
	clearInterval(timer)
},function(){

timer = setInterval(function(){
		if(i < maxImage){
			i++
			
			}else{
				i = 0
			}
portImg.removeClass('active');
thumbImg.removeClass('thumbact');

portImg.eq(i).addClass('active');
thumbImg.eq(i).addClass('thumbact');},400)

});

*/
}

	

});

/*======================================================
======================================================

Web work

======================================================
======================================================*/





App.PortfolioWebworkController = Ember.Controller.extend({
	hiredsites:[
	{
		name:'DawnEPhoto.com',
		url:'http://www.dawnephoto.com',
		img:'images/hiredsites/dawnephoto.png',
		languages:['HTML','CSS', 'javascript', 'PHP']
	},
	{
		name:'Sunchips.com',
		url:'http://www.sunchips.com',
		img: 'images/hiredsites/sunchips.png',
		languages:['HTML','CSS', 'javascript', 'PHP']

	},
	{
		name:'CancerSpokenHere.com',
		url:'http://www.cancerspokenhere.com',
		img:'images/hiredsites/cancerspokenhere.png',
		languages:['HTML','CSS','javascript', 'PHP']
		
	},
	{
		name:'ClassicKidsPhotography.com',
		url:'http://www.classickidsphotography.com',
		img:'images/hiredsites/classickids.png',
		languages:['AS3']
		
	}
	]
	
});


App.PortfolioWebworkView = Ember.View.extend({
	classNames: ['webwork, inline'],
	templateName: "portfolioWebwork",
	didInsertElement:function(){ 
		var btnsLength = $('#btns li').length
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {

$('#btns li a').children('div').css('top', '-100px')
						
						
		

}else{
	$('#btns li a').hover(function(){
			$(this).children('div').animate({
				top:'-150px'
				} ,100)
						
	
				}, function(){
					$(this).children('div').animate({
						top:'0px'
						} ,200)
					});
	}
}
});





App.InfoController = Ember.Controller.extend({

	workExp:
	[{
			name:'Energy BBDO',
			title: ['Web Developer','Photographer','Studio Production Artist'],
			duration: [
				{ startTime: 'Jan. 2012', endTime: 'Present' }
			]
			
		}],
	internship: 
		{
			name: 'Energy BBDO',
			title: ['Web Developer','Photographer','Studio Production Artist'],
			startTime: 'May 2011', 
			endTime: 'Jan. 2012' 
		},
	freelanceWork: 
		[
		{
			name: 'Dawn Roscoe',
			title: 'Designer and Web Developer',
			duration:[
				{ startTime: 'Apr. 2013', endTime: ''}
			]
			
			
		},
		{
			name: 'Cancer Spoken Here',
			title: 'Designer and Web Developer',
			duration:[
				{ startTime: 'Aug. 2011', endTime: 'Feb. 2012' }
			]
			
			
		},
		{
			name: 'Dawn Roscoe',
			title: 'Designer and Web Developer',
			duration:[
				{ startTime: 'Aug. 2011', endTime: 'Dec. 2012' }
				
			]
			
			
		},
		{
			name: 'Schneider Gallery',
			title: 'IT Support',
			duration:[
				{ startTime: 'Mar. 2011', endTime: 'Present' }
			]
			
			
		},
		{
			name: 'George Street Photo and Video',
			title: 'Wedding Image Optimizer',
			duration:[
				{ startTime: 'Feb. 2011', endTime: 'Mar. 2011'},
			]
		
		},
		{
			name: 'Jennifer Keats',
			title: 'Web Developer / Assistant',
			duration:[
				{ startTime: 'Nov. 2010', endTime: 'Jan. 2011' }
			
			]
			
			
		},
		{
			name: 'George Street Photo and Video',
			title: 'Wedding Image Optimizer',
			duration:[
				{ startTime:  'Sept. 2010', endTime: 'Dec. 2010'}
			]
		
		}

		]
	
});

	

