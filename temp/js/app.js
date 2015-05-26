
App = Ember.Application.create({
	LOG_TRANSITIONS: true
});

/* ===========================

##Routes

=============================*/

App.Router.map(function() {
	this.route('index', { path: '/' });
	this.route('portfolio');
	this.route('info')
});

App.IndexView = Ember.View.extend({
didInsertElement: function(){ 	$('img').bind("contextmenu",function(e){  
        return false;  
})
}
});


/* ===========================

##port

=============================*/

App.PortfolioController = Ember.ArrayController.extend({
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
			url:"images/circle_R4.jpg"
		}
		
	
	]
});



App.PortfolioView = Ember.View.extend({
classNames: ['portfolio '],
didInsertElement: function(){ 
	var portfolio = $('.portfolio');
	var activeImg = $('.portfolio img:first')
	var portImg = $('.portfolio img')
	var	maxImage = portfolio.children('img').length -1;
	var i;
	//intalize
		activeImg.addClass('active');
		i = 0;

	//timer
	setInterval(function(){
	
		if(i < maxImage){
			i++
			
			}else{
				i = 0
			}
portImg.removeClass('active');
portImg.eq(i).addClass('active');
	
	
},7000)

 $('img').bind("contextmenu",function(e){  
        return false;  
    });  


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

	

