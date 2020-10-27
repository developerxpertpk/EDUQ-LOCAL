(function( $ ) {
	'use strict';
	//document ready
	$(function(){

		//only show one review per a slide on mobile
		//get the attribute if it is set and this is in fact a slider
		$(".wprev-slider").each(function(){
			var oneonmobile = $(this).attr( "onemobil" );
			if(oneonmobile=='yes'){
				if (/Mobi|Android/i.test(navigator.userAgent) || $(window).width()<600) {
					/* this is a mobile device, continue */
					//get all the slider li elements, each li is a slide
					var li_elements_old = $(this).children('ul');
					//console.log(li_elements_old);
					if(li_elements_old.length>0){
						//get array of all the divs containing the individual slide
						var divrevs = li_elements_old.find('.w3_wprs-col');
						var divrevarray = divrevs.get();
						//get the classes of the 2 divs under the li
						var div1class = divrevs.parent().attr('class');
						var div2class = divrevs.attr('class');
						//only continue if finding the divs
						if(typeof div2class !== "undefined"){
							//remove the l2, l3, l4, l5 , l6
							div2class = div2class.replace(/[a-z]\d\b/g, 'l12');
							//use the divrevarray to make new li elements with one review in each
							var newulhtml = '';
							var i;
							for (i = 0; i < divrevarray.length; i++) { 
								if(i==0){
									newulhtml += '<li class="wprs_unslider-active"><div class="'+div1class+'"><div class="'+div2class+'">'+divrevarray[i].innerHTML + '</div></div></li>';
								} else {
									newulhtml += '<li><div class="'+div1class+'"><div class="'+div2class+'">'+divrevarray[i].innerHTML + '</div></div></li>';
								}
							}
							//add the load more button if found
							if($(this).find('.wprevpro_load_more_div')[0]!== undefined){
								newulhtml += '<li>'+$(this).find('.wprevpro_load_more_div')[0].outerHTML+'</li>';
							}
							newulhtml +='';
							//replace the old li with the new
							li_elements_old.html(newulhtml);
							//re-initialize the slider if we need to
						}
					}
				}
			}
		});
		//}
		//----------------------

		var savedheight= {};
		var wprevsliderini_height= {};
		var wprevsliderini_height_widget= {};
		var smallestwprev= {};

			$( ".wprevpro" ).on( "click", ".wprs_rd_more", function(event) {
				event.preventDefault();

				//var oldheight = $(this).parent().parent().height();	//height of individual review indrevdiv
				var oldheight = $(this).closest('.indrevdiv').height();
				//var oldouterheight = $(this).parent().parent().outerHeight();
				var oldouterheight = $(this).closest('.indrevdiv').outerHeight();

				//save these heights in an object so we can access them from read less click.
				var sliderid = $(this).closest('.wprev-slider').attr('id');
				var slideid = sliderid+'-'+$(this).closest('.w3_wprs-col').index();
				var li_id = sliderid+'-'+$(this).closest('li').index();
				
				//save heights to use later
				savedheight[slideid] =$(this).closest('.indrevdiv').css("height");
				wprevsliderini_height[slideid] = $(this ).closest('.wprev-slider').css("height");
				wprevsliderini_height_widget[slideid] = $(this ).closest('.wprev-slider-widget').css("height");
				
				if(Number(wprevsliderini_height[slideid])<Number(smallestwprev[li_id]) || !smallestwprev[li_id] || typeof smallestwprev[li_id] === 'undefined'){
					//save the smallest value in this object, use if needed
					smallestwprev[li_id]=wprevsliderini_height[slideid];
				}
				if(Number(wprevsliderini_height_widget[slideid])<Number(smallestwprev[li_id]) || !smallestwprev[li_id] || typeof smallestwprev[li_id] === 'undefined'){
					//save the smallest value in this object, use if needed
					smallestwprev[li_id]=wprevsliderini_height_widget[slideid];
				}
				
				//console.log('wprevsliderini_height'+wprevsliderini_height);
				//console.log(wprevsliderini_height);
				//console.log('smallestwprev'+smallestwprev);
				//console.log(smallestwprev);
				
				$(this).closest('.indrevdiv').css( 'height', 'auto' );
				$(this).closest('.indrevdiv').parent().css( 'height', 'auto' );
				$(this ).hide();
				$( this ).prevAll('span.wprs_rd_more_1').hide();
				$( this ).next('span').show(0, function() {
					// Animation complete.
					$( this ).css('display', 'inline');
					$( this ).next('.wprs_rd_less').show();
					//only do this for slider or grid that is same height, also doing this for Fade transition
					if(!$(this).closest('.wprevpro').hasClass('revnotsameheight')){
						//waiting a bit for chrome
						var morelink = $(this);
						setTimeout ( function () {
							setmoreheight(morelink);
						}, 10);
					}
				});

				var newheight =$(this).closest('.indrevdiv').height();
				//fix if we made smaller then set back to what it was.
				//only do this for slider or grid that is same height----
				if(!$(this).closest('.wprevpro').hasClass('revnotsameheight')){
					//return false;
					if(newheight<oldheight){
						if(oldouterheight>oldheight){
							$(this).closest('.indrevdiv').css( 'height', oldouterheight );
						}else {
							$(this).closest('.indrevdiv').css( 'height', oldheight );
						}
					}
				}
			});
			
			
			function setmoreheight(morelink){
				//find height of .wprs_unslider-active then set .wprev-slider, only change if bigger
				var liheight = $(morelink).closest( '.wprs_unslider-active' ).outerHeight(true);
				//find max height of all slides
				var heights = $(morelink).closest('.wprs_unslider').find( "li" ).map(function ()
							{
								return $(this).outerHeight();
							}).get(),
				overallheight = Math.max.apply(null, heights);
				
				//console.log('li:'+liheight);
				//console.log('o:'+overallheight);
				
				if(liheight>overallheight || liheight==overallheight){
					$(morelink ).closest( '.wprev-slider' ).animate({height: liheight,}, 300 );
					$(morelink ).closest( '.wprev-slider-widget' ).animate({height: liheight,}, 300 );
				} else if(overallheight>100) {
					$(morelink ).closest( '.wprev-slider' ).animate({height: overallheight,}, 300 );
					$(morelink ).closest( '.wprev-slider-widget' ).animate({height: overallheight,}, 300 );
				}
			}
			
			//read less click
			$( ".wprevpro" ).on( "click", ".wprs_rd_less", function(event) {
				event.preventDefault();
				//get the slide ID of this read less so we know which height to pull
				var sliderid = $(this).closest('.wprev-slider').attr('id');
				var slideid = sliderid+'-'+$(this).closest('.w3_wprs-col').index();
				var li_id = sliderid+'-'+$(this).closest('li').index();
				$(this ).hide();
				$( this ).prev('span').hide( 0, function() {
					$(this ).prevAll('.wprs_rd_more').show();
					$( this ).prevAll('span.wprs_rd_more_1').show();
				});
				if(!$(this).closest('.wprevpro').hasClass('revnotsameheight')){
					//check if there are no readless then use smallest value
					var checkreadless = $(this ).closest('.wprevprodiv').find('.wprs_rd_less:visible').length;
					//if checkreadless = 0 then we need to make smallest
					var tempsliderheight = wprevsliderini_height[slideid];
					var tempsliderheightwidget = wprevsliderini_height_widget[slideid];
					if(checkreadless==0){
						tempsliderheight = smallestwprev[li_id];
						tempsliderheightwidget = smallestwprev[li_id];
					}
					$(this ).closest('.indrevdiv').animate({
						height: savedheight[slideid],
					  }, 0 );
					$(this ).closest('.wprev-slider').animate({
						height: tempsliderheight,
					 }, 200 );
					$(this ).closest('.wprev-slider-widget').animate({
						height: tempsliderheightwidget,
					  }, 200 );
				}

			});
			

			//autopop-up
			formautopopupcheck();
			function formautopopupcheck(){
				//search for form on page and see if it has autopop attr
				var wprevform = $('.wprevpro_form');
				if(wprevform.attr("autopopup")=='yes'){
					wprevform
					var modal = wprevform.find('.wprevmodal_modal');
					modal.show();
					wprevform.find(".wprevpro_form_inner").show();
				}
			}
			//show form on button click
			$(".wprevpro_btn_show_form").click(function(event){
				var formid = $(this).attr("formid");
				//make sure msgdb is hidden
				$(this).closest('#wprevpro_div_form_'+formid).find(".wprevpro_form_msg").hide();
				
				
				//see if this is a pop-up or slide down
				if($(this).attr('ispopup')=='yes'){
					//this is a pop-up
					// Get the modal
					var modal = $("#wprevmodal_myModal_"+formid);
					modal.show();
					$("#wprevpro_div_form_inner_"+formid).show();
				} else {
					//if this was autopopped then we need to remove modal, we won't be using again
					if($(this).closest('#wprevpro_div_form_'+formid).attr("autopopup")=='yes'){
						//destroy modal
						$(this).closest('#wprevpro_div_form_'+formid).find('.wprevmodal_modal').unbind();
						$(this).closest('#wprevpro_div_form_'+formid).find('.wprevmodal_modal').show();
						$(this).closest('#wprevpro_div_form_'+formid).find('.wprevmodal_modal').removeClass('wprevmodal_modal');
						$(this).closest('#wprevpro_div_form_'+formid).find('.wprevmodal_modal-content').removeClass('wprevmodal_modal-content');
						$(this).closest('#wprevpro_div_form_'+formid).find('.wprevmodal_close').html('');
						
					}
					
					$(this).next().find(".wprev_review_form").show();
					$(this).next().find(".wprevpro_form_inner").toggle(1000);
					
					
				}

			});
			//close model if not clicked on 
			$(".wprevmodal_modal").click(function(event){
				if(!$(event.target).closest('.wprevmodal_modal-content').length){
					$(this).hide();
					$(this).find(".wprevpro_form_inner").hide();
				}
			});
			//close modal on x click
			$(".wprevmodal_close").click(function(event){
					$(this).closest('.wprevmodal_modal').hide();
					$(this).closest('.wprevmodal_modal').find(".wprevpro_form_inner").hide();
			});
			
			//check the form on submit  
			$(".wprev_review_form").submit(function(event){
				var ratingreq = '';
				ratingreq = $( this ).find('#wprevpro_rating_req').val();
				if(ratingreq=="yes"){
					var checkedvalue = $('input[name=wprevpro_review_rating]:checked').val();
					if ($('input[name=wprevpro_review_rating]:checked').length && checkedvalue!='0') {
					   // at least one of the radio buttons was checked
					   //return true; // allow whatever action would normally happen to continue
					} else {
						   // no radio button was checked
						   alert('Please select a rating.');
						   $( ".wprevpro-rating" ).focus();
						   event.preventDefault(); 
						   return false; // stop whatever action would normally happen
					}
				}
			});
			
			//check if this browser supports ajax file upload FormData
			function wprev_supportFormData() {
				return !! window.FormData;
			}
			
			function hideshowloader(buttondiv,showloader){
				//hide the sumbit button so they don't push twice
				if(showloader==true){
					buttondiv.hide();
					buttondiv.next('.wprev_loader').show();
				} else {
					buttondiv.show();
					buttondiv.next('.wprev_loader').hide();
				}
			}
			
			function resetform(theform){
				$(theform).trigger("reset");
			}
			
			function closeformandscroll(showformbtn){
				//wait a couple of seconds, hide the form after the message is shown. only on hidden form
				if ( showformbtn.length ) {
					setTimeout(function(){
						showformbtn.next().find(".wprevpro_form_inner").toggle(1000);
						//scroll up back to button
						$('html, body').animate({scrollTop: $( ".wprevpro_btn_show_form" ).offset().top-200}, 1000);
					}, 1500);
				}
			}
			
			//when clicking stars on preview form
			$('.wprevpro-rating-radio-lbl').click(function() {
				var clickedstar = $( this ).prev().val();
				var clickedelement = $( this );
				hideshowrestofform(clickedelement,clickedstar);
			});
			//when clicking thumbs up or down
			$('.wprevpro_form').on( "click", "#wppro_fvoteup", function() {
				var clickedstar = 5;
				var clickedelement = $( this );
				//set radio
				$("#wprevpro_review_rating-star5").prop("checked", true);
				//remove and add class to show filled in value, different for smiles
				changthumbonclick('up',clickedelement);
				//find out if we are hiding social links logic
				hideshowrestofform(clickedelement,clickedstar);
			});
			$('.wprevpro_form').on( "click", "#wppro_fvotedown", function() {
				var clickedstar = 2;
				var clickedelement = $( this );
				changthumbonclick('down',clickedelement);
				//set radio
				$("#wprevpro_review_rating-star2").prop("checked", true);
				//find out if we are hiding social links logic
				hideshowrestofform(clickedelement,clickedstar);
			});
			//for changing thumbs icons on click wppro_updown_yellobg
			function changthumbonclick(voteupdown,clickedelement){
				var voteupbtn = clickedelement.closest('.wprevpro-rating').find('#wppro_fvoteup');
				var votedownbtn = clickedelement.closest('.wprevpro-rating').find('#wppro_fvotedown');
				if(voteupdown=='up'){
					if(voteupbtn.hasClass( "wprsp-thumbs-o-up" )){
						voteupbtn.removeClass( "wprsp-thumbs-o-up" );
						voteupbtn.addClass( "wprsp-thumbs-up" );
						votedownbtn.removeClass( "wprsp-thumbs-down" );
						votedownbtn.addClass( "wprsp-thumbs-o-down" );
					} else if(voteupbtn.hasClass( "wprsp-smile-o" )){
						voteupbtn.addClass( "wppro_updown_yellobg" );
						votedownbtn.removeClass( "wppro_updown_yellobg" );
					}
				} else if(voteupdown=='down'){
					if(voteupbtn.hasClass( "wprsp-thumbs-up" )){
						voteupbtn.addClass( "wprsp-thumbs-o-up" );
						voteupbtn.removeClass( "wprsp-thumbs-up" );
						votedownbtn.addClass( "wprsp-thumbs-down" );
						votedownbtn.removeClass( "wprsp-thumbs-o-down" );
					} else if(votedownbtn.hasClass( "wprsp-frown-o" )){
						votedownbtn.addClass( "wppro_updown_yellobg" );
						voteupbtn.removeClass( "wppro_updown_yellobg" );
					}
				}
			}
			
			//hiding or showing rest of form logic
			function hideshowrestofform(clickedelement,clickedstar){
				
				var globshowval = $( clickedelement ).closest('form').find('#wprev_globshowval').val();
				var globhiderest = $( clickedelement ).closest('form').find('#wprev_globhiderest').val();
				if(globshowval!=''){
					if(clickedstar>globshowval){
						//show social links
						$( clickedelement ).closest('form').find('.wprevpro-field-social_links').removeClass('hideme');
						$( clickedelement ).closest('form').find('.wprevpro-field-social_links').hide();
						$( clickedelement ).closest('form').find('.wprevpro-field-social_links').show('2000');
						//what to do with rest of form
						if(globhiderest=='hide'){
							$( clickedelement ).closest('form').find('.rofform').hide();
						}
					} else {
						$( clickedelement ).closest('form').find('.wprevpro-field-social_links').hide('2000');
						//what to do with rest of form
						if(globhiderest=='hide'){
							$( clickedelement ).closest('form').find('.rofform').show('2000');
						}
					}
				}
			}
			
			$( '#wprevpro_submit_ajax' ).click(function(event) {
				//ajax form submission
				//find the form id based on this button
				var thisform = $(this).closest('form');
				var thisformcontainer = $(this).closest('.wprevpro_form');
				var thisformdbmsgdiv = thisformcontainer.find('.wprevpro_form_msg');
				var thisformsbmitdiv = thisform.find('.wprevpro_submit');
				var thisshowformbtn = thisformcontainer.find('.wprevpro_btn_show_form');
				
				//hide the sumbit button so they don't push twice
				hideshowloader(thisformsbmitdiv,true);
				thisformdbmsgdiv.removeClass('wprevpro_submitsuccess');
				thisformdbmsgdiv.removeClass('wprevpro_submiterror');
				
				var fileuploadinput = thisform.find('#wprevpro_review_avatar');
				//default to formdata, but use serialize if not uploading file and browser supports it
				var useserializemethod = false;
				
				//check if we are uploading a file, if so then see if browser supports. if not then use regular submit
				var imgVal = fileuploadinput.val(); 
				var checkformdatasupport = wprev_supportFormData();
				if(imgVal!="" && checkformdatasupport==false){
					//formdata not supported
					return false;
				} else {
					//stop regular form submission continue with ajax
					event.preventDefault();
					if(checkformdatasupport==false){
						useserializemethod = true;
					}
				}

				//if we are not uploading a file use the serialize method
				if(useserializemethod==true){
					var stringofvariables = thisform.serialize();
					//console.log(stringofvariables);
				
					var senddata = {
						action: 'wprp_save_review',	//required
						wpfb_nonce: wprevpublicjs_script_vars.wpfb_nonce,
						cache: false,
						processData : false,
						contentType : false,
						data: stringofvariables,
						};
					//send to ajax to update db
					var jqxhr = jQuery.post(wprevpublicjs_script_vars.wpfb_ajaxurl, senddata, function (data){
						console.log(data);
						var jsondata = $.parseJSON(data);
						if(jsondata.error=="no"){
								hideshowloader(thisformsbmitdiv,false);
								//display success message
								thisformdbmsgdiv.html(jsondata.successmsg);
								thisformdbmsgdiv.addClass('wprevpro_submitsuccess');
								thisformdbmsgdiv.show('slow');
								resetform(thisform);
								closeformandscroll(thisshowformbtn);
						} else {
								//display error message
								hideshowloader(thisformsbmitdiv,false);
								thisformdbmsgdiv.html(jsondata.dbmsg);
								thisformdbmsgdiv.addClass('wprevpro_submiterror');
								thisformdbmsgdiv.show('slow');
						}
						
					});
					jqxhr.fail(function() {
					  //display error message
						hideshowloader(thisformsbmitdiv,false);
						thisformdbmsgdiv.html(jsondata.dbmsg);
						thisformdbmsgdiv.addClass('wprevpro_submiterror');
						thisformdbmsgdiv.show('slow');
						hideshowloader(thisformsbmitdiv,false);
					});
				
				} else {
					//use formdata method
					//now using formdata so we can upload, almost works in all browsers
					var formdata = new FormData(thisform[0]);
					formdata.append('action', 'wprp_save_review');
					formdata.append('wpfb_nonce', wprevpublicjs_script_vars.wpfb_nonce);

					$.ajax({
						url: wprevpublicjs_script_vars.wpfb_ajaxurl,
						action: 'wprp_save_review',	//required
						wpfb_nonce: wprevpublicjs_script_vars.wpfb_nonce,
						type: 'POST',
						data: formdata,
						contentType:false,
						processData:false,
						success: function(data){
							var jsondata = $.parseJSON(data);
							console.log(jsondata);
							if(jsondata.error=="no"){
								hideshowloader(thisformsbmitdiv,false);
								//display success message
								thisformdbmsgdiv.html(jsondata.successmsg);
								thisformdbmsgdiv.addClass('wprevpro_submitsuccess');
								thisformdbmsgdiv.show('slow');
								resetform(thisform);
								closeformandscroll(thisshowformbtn);
							} else {
								//display error message
								hideshowloader(thisformsbmitdiv,false);
								thisformdbmsgdiv.html(jsondata.dbmsg);
								thisformdbmsgdiv.addClass('wprevpro_submiterror');
								thisformdbmsgdiv.show('slow');
							}
						  },
						error: function(data){
							var jsondata = $.parseJSON(data);
							console.log(jsondata);
							//display error message
								hideshowloader(thisformsbmitdiv,false);
								thisformdbmsgdiv.html(jsondata.dbmsg);
								thisformdbmsgdiv.addClass('wprevpro_submiterror');
								thisformdbmsgdiv.show('slow');
						  },
					});
					
				}

			});

			//for clicking the floating badge or a badge with a slide-out
			$( ".wprevpro_badge_container" ).click(function(event) {
				//first close any open popups or sliders
				$('.wprevpro_slideout_container').hide();
				
			var onclickaction = $(this).attr('onc');
			var onclickurl =  $(this).attr('oncurl');
			var onclickurltarget =  $(this).attr('oncurltarget');
			var badgeid = $(this).attr('badgeid');
			//only do this if not clicking an arrow  wprs_rd_less  wprev_pro_float_outerdiv-close  wprevpro_load_more_btn
			if(!$(event.target).closest('.wprs_unslider-arrow').length && !$(event.target).closest('.wprs_rd_less').length && !$(event.target).closest('.wprs_rd_more').length && !$(event.target).closest('.wprs_unslider-nav').length && !$(event.target).closest('a').length && !$(event.target).closest('.wprevpro_load_more_btn').length  && !$(event.target).closest('.wprev_pro_float_outerdiv-close').length) {
				if(onclickaction=='url'){
					if(onclickurl!=""){
						if(onclickurltarget=='same'){
							var win = window.open(onclickurl, '_self');
						} else {
							var win = window.open(onclickurl, '_blank');
						}
						if (win) {
							//Browser has allowed it to be opened
							win.focus();
						} else {
							//Browser has blocked it
							alert('Please allow popups for this website');
						}
					} else {
						alert("Please enter a Link to URL value.");
					}
					return false;
				} else if(onclickaction=='slideout'){
					//slideout the reviews from the side, find the correct one in relation to this click 
					//$(this).siblings('.wprevpro_slideout_container').toggle();
					$( "#wprevpro_badge_slide_"+ badgeid).toggle();
					return false;
				} else if(onclickaction=='popup'){
					//slideout the reviews from the side, find the correct one in relation to this click 
					//$(this).siblings('.wprevpro_popup_container').toggle();
					$( "#wprevpro_badge_pop_"+ badgeid).toggle();
					//if this is a showing a slider we need to unset the height
					setTimeout(function(){
					  $( "#wprevpro_badge_pop_"+ badgeid).find('.wprs_unslider').css('margin-left', '25px');
					  $( "#wprevpro_badge_pop_"+ badgeid).find('.wprs_unslider').css('margin-right', '25px');
					  $( "#wprevpro_badge_pop_"+ badgeid).find('.wprev-slider').css('height', 'unset');
					}, 200);
					return false;
				}
			}
		});
		//close slideout onclick on everything but it, also using if the slide out was opened from a badge
		$(document).click(function(event) { 
			if(!$(event.target).closest('.wprevpro_slideout_container').length && !$(event.target).closest('.updatesliderinput').length  && !$(event.target).closest('.wprevpro_badge').length) {
				if($('.wprevpro_slideout_container').is(":visible")) {
					$('.wprevpro_slideout_container').hide();
				}
			}        
		});
		//close slide-out on x click
		$(".wprevslideout_close").click(function(event){
				$(this).closest('.wprevpro_slideout_container').hide();
		});

		//for admin preview
		$( "#preview_badge_outer" ).on( "click", ".wprevpro_load_more_btn", function(event) {
				//need function to load more.
				loadmorerevs(this);
		});
		
			
		var lastclickedpagenum = 1;
		var loadedpagehtmls={};
		//need to find first page of reviews if this is a pagination and save to global loadedpagehtmls
		//look for pagination div
		$( ".wppro_pagination" ).each(function( index ) {
			//find templateid
			var templateid = Number($( this ).attr( "tid" ));
			var ismasonry = $(this).attr('ismasonry');
			if(ismasonry=='yes'){
				var clone = $( this ).closest('div.wprevpro').find('div.wprs_masonry').clone();
			} else {
				var clone = $( this ).closest('div.wprevpro').clone();
			}

			clone.find('.wppro_pagination').remove();
			var reviewshtml = clone.html();
			//save in global, different if masonry

			loadedpagehtmls['tid'+templateid+'p'+1]=reviewshtml;
		});
		
		//for searching pagination text
		var txtsearchtimeout = null;
		$('.wprev_search').on('input', function() {
			var myValue = $(this).val();
			var myLength = myValue.length;
			clearTimeout(txtsearchtimeout);
			if(myLength>1 || myLength==0){
				//search here
				// Make a new timeout set to go off in 800ms
				txtsearchtimeout = setTimeout(function () {
					console.log(myLength);
					var parentdiv = $(this).closest('.wprev_search_sort_bar').next('.wprevpro').find('.wppro_pagination');
					//fix if searching using Load More button
					if(!parentdiv.length){
						parentdiv = $(this).closest('.wprev_search_sort_bar').next('.wprevpro').find('.wprevpro_load_more_btn');
					}
			
					$(this).closest('.wprev_search_sort_bar').find('.wprppagination_loading_image_search').show();
					startofgetpagination(1,parentdiv);
				}.bind(this), 600);
			}
		});
		//for using sort drop down on reviews
		$('.wprev_sort').on('change', function() {
			var myValue = $(this).val();
			var myLength = myValue.length;
			if(myLength>0 || myLength==0){
				var parentdiv = $(this).closest('.wprev_search_sort_bar').next('.wprevpro').find('.wppro_pagination');
				//fix if searching using Load More button
					if(!parentdiv.length){
						parentdiv = $(this).closest('.wprev_search_sort_bar').next('.wprevpro').find('.wprevpro_load_more_btn');
					}
				$(this).closest('.wprev_search_sort_bar').find('.wprppagination_loading_image_search').show();
				startofgetpagination(1,parentdiv);
			}
		});
		//for clicking a quick search tag
		$('.wprevpro_stag').on('click', function() {
			//if this already has the class current then we unsearch
			if($(this).hasClass('current')){
				$('.wprev_search').val('');
				$(this).removeClass('current');
			} else {
				var myValue = $(this).text();
				//remove all other current classes if we picked before
				$('.wprevpro_stag').removeClass('current');
				$(this).addClass('current');
				$('.wprev_search').val(myValue);
			}
			
			var parentdiv = $(this).closest('.wprev_search_sort_bar').next('.wprevpro').find('.wppro_pagination');
			//fix if searching using Load More button
				if(!parentdiv.length){
					parentdiv = $(this).closest('.wprev_search_sort_bar').next('.wprevpro').find('.wprevpro_load_more_btn');
				}
			$(this).closest('.wprev_search_sort_bar').find('.wprppagination_loading_image_tag').show();
			startofgetpagination(1,parentdiv);

		});
		//for pagination click, ajax second page add to html, only doing for grid
		$( ".wppro_pagination" ).on( "click", ".wppro_page_numbers", function(event) {
			event.stopPropagation();
			event.preventDefault();
			var clickedthis = this;
			var parentdiv = $(clickedthis).closest('.wppro_pagination');
			var clickedpagenum = $(clickedthis).text();
			startofgetpagination(clickedpagenum,parentdiv);
		});
		//function to start get pagination data
		function startofgetpagination(clickedpagenum,parentdiv){
			//check if arrow clicked
			if(clickedpagenum=='>'){
				clickedpagenum = 1 + Number(lastclickedpagenum);
			} else if(clickedpagenum=='<'){
				clickedpagenum = Number(lastclickedpagenum)-1;
			} else {
				clickedpagenum = Number(clickedpagenum);
			}
			//if nothing clicked then this is first page
			if(clickedpagenum<2){
				clickedpagenum = 1;
			}
			
			var numperrow = $(parentdiv).attr('perrow');
			var numrows = $(parentdiv).attr('nrows');
			var cnum = '';
			var revtemplateid = $(parentdiv).attr('tid');
			var notinstr = $(parentdiv).attr('notinstring');
			var cpostid = Number($(parentdiv).attr('cpostid'));
			var shortcodepageid = $(parentdiv).attr('shortcodepageid');
			var shortcodelang = $(parentdiv).attr('shortcodelang');
			
			var ismasonry = $(parentdiv).attr('ismasonry');
			var revsameheight = $(parentdiv).attr( "revsameheight" );
			var lastslidenum = $(parentdiv).attr('lastslidenum');
			var totalreviewsindb = $(parentdiv).attr('totalreviewsindb');
			
			var spinner = $(parentdiv).find( ".wprppagination_loading_image" );
			//spinner.show();
			//see if we have search text
			var searchtext = $(parentdiv).closest('.wprevpro').prev('.wprev_search_sort_bar').find('.wprev_search').val();
			if(!searchtext){
				spinner.show();
			}
			//override searchtext if we clicked a tag
			if($('.wprevpro_stag.current').text()!=''){
				searchtext = $('.wprevpro_stag.current').text();
			}
			
			//see if we are overriding default sort
			var sorttext = $(parentdiv).closest('.wprevpro').prev('.wprev_search_sort_bar').find('#wprevpro_header_sort').val();
			
			//see if we have a rating specified
			var ratingfilter = $(parentdiv).closest('.wprevpro').prev('.wprev_search_sort_bar').find('#wprevpro_header_rating').val();
			
			//see if we have a language specified
			var langfilter = $(parentdiv).closest('.wprevpro').prev('.wprev_search_sort_bar').find('#wprevpro_header_langcodes').val();

			//make ajax call
			 var senddata = {
				action: 'wprp_load_more_revs',	//required
				wpfb_nonce: wprevpublicjs_script_vars.wpfb_nonce,
				cache: false,
				processData : false,
				contentType : false,
				perrow: numperrow,
				nrows: numrows,
				callnum: cnum,
				clickedpnum: clickedpagenum,
				notinstring:notinstr,
				revid: revtemplateid,
				onereview: 'no',
				cpostid: cpostid,
				shortcodepageid: shortcodepageid,
				shortcodelang: shortcodelang,
				textsearch: searchtext,
				textsort: sorttext,
				textrating: ratingfilter,
				textlang: langfilter,
				};
			console.log(senddata);
			//send to ajax to update db
			var paginationhtml = '';
			var havepagesaved = false;
			
			//check to see if this page html has been viewed before, load if so.
			console.log(loadedpagehtmls);
			var property = 'tid'+senddata.revid+'p'+senddata.clickedpnum;

			if (typeof loadedpagehtmls[property] !== 'undefined'){
				havepagesaved = true;
			}
			
			//only saving if not using a filter
			if(havepagesaved && !searchtext && !sorttext && ratingfilter=='unset' && langfilter=='unset'){
				var jsondata = new Object();
				jsondata['innerhtml'] = loadedpagehtmls[property];
				jsondata['clickedpnum'] =senddata.clickedpnum;
				jsondata['lastslidenum'] = lastslidenum;
				jsondata['totalreviewsindb'] = totalreviewsindb;
				jsondata['reviewsperpage'] = Number(numperrow)*Number(numrows);
				loadnextpaginationpage(senddata,spinner,ismasonry,revsameheight,parentdiv,jsondata);
			} else {
				//check to see if this is a button. Button will not have spinner div
				if(!spinner.length){
					//change parentdiv here to div above btn
					parentdiv = parentdiv.parent('.wprevpro_load_more_div');
				}
				ajaxcallforpagination(senddata,spinner,ismasonry,revsameheight,parentdiv);

			}
			
		}
		
		//ajax call for next pagination page clicked
		function ajaxcallforpagination(senddata,spinner,ismasonry,revsameheight,parentdiv){
			var jsondata = '';
			var jqxhr = jQuery.post(wprevpublicjs_script_vars.wpfb_ajaxurl, senddata, function (data){
					var IS_JSON = true;
					//console.log(data);
					//strip everything outside of {}, workaround when wordpress generates and message
					data = data.substring(0, data.indexOf('}')+1);
					try
					   {
							var jsondata = $.parseJSON(data);
					   }
					   catch(err)
					   {
						   IS_JSON = false;
							spinner.hide();
					   }
					   
					if(data && data!="" && IS_JSON){
						//update notinstring
						$(parentdiv).attr('notinstring',jsondata.newnotinstring);
						//if this is button then also update it
						$(parentdiv).find('.wprevpro_load_more_btn').attr('notinstring',jsondata.newnotinstring);
						loadnextpaginationpage(senddata,spinner,ismasonry,revsameheight,parentdiv,jsondata);
					}
				});
				jqxhr.fail(function() {
					  //display error message
						console.log("fail");
						spinner.hide();
						return;
				});
		}
		//actually going to build pagination page here
		function loadnextpaginationpage(senddata,spinner,ismasonry,revsameheight,parentdiv,jsondata){
			var paginationhtml = '';
			if(jsondata!=''){
				var innerrevhtml = jsondata.innerhtml;

				//only saving html if not searching or filtering by lang or rating
				if(senddata.textsearch=='' && senddata.textlang=='unset' && senddata.textrating=='unset' ){
					loadedpagehtmls['tid'+senddata.revid+'p'+senddata.clickedpnum]=innerrevhtml;
				}
				$('.wprppagination_loading_image_search').hide();
				$('.wprppagination_loading_image_tag').hide();

				//console.log(loadedpagehtmls);
				
				//replace the reviews, different if ismasonry
				if(ismasonry=='yes'){
					
					 $(parentdiv).prevAll( "div.wprs_masonry" ).fadeOut(200).promise().done(function(){
						 $(parentdiv).prevAll( "div.wprs_masonry" ).html('');
						 $(parentdiv).prevAll( "div.wprs_masonry" ).append(innerrevhtml);
						 $(parentdiv).prevAll( "div.wprs_masonry" ).fadeIn(200);
						 if(revsameheight=='yes'){
							checkfixheightgrid(parentdiv);
						}
					 });

				} else {
					$(parentdiv).prevAll( "div.wprevprodiv" ).fadeOut(200).promise().done(function(){
						 $(parentdiv).prevAll( "div.wprevprodiv" ).remove();
						 $(parentdiv).closest("div.wprevpro").prepend(innerrevhtml);
						 $(parentdiv).prevAll( "div.wprevprodiv" ).fadeIn(200);
						 if(revsameheight=='yes'){
							checkfixheightgrid(parentdiv);
						}
					 });
				 
				}
				
				
				
				lastclickedpagenum = Number(jsondata.clickedpnum);
				var lastslidenum = Number(jsondata.lastslidenum);
				var temptotalrevsindb = Number(jsondata.totalreviewsindb);
				var tempreviewsperpage = Number(jsondata.reviewsperpage);
				var chtml = '';
				spinner.hide();
				//redraw pagination buttons, only if we don't see all reviews on this page and we are using pagination not load more btn
				if(spinner.length){
					paginationhtml = '<ul class="wppro_page_numbers_ul">';
					if(temptotalrevsindb > tempreviewsperpage){
						
						if(lastclickedpagenum>1){
							paginationhtml =  paginationhtml +'<li><span class="brnprevclass wppro_page_numbers"><</span></li>';
						}
						if(lastclickedpagenum==1){
							chtml ='current';
						}
						//always add first page
						paginationhtml =  paginationhtml +'<li><span class="brnprevclass wppro_page_numbers '+chtml+'">1</span></li>';
						//add dots if needed to start
						if(lastclickedpagenum>3){
							paginationhtml =  paginationhtml +'<li><span class="brnprevclass wppro_page_dots">…</span></li>';
						}
						
						for (var i = 2; i < lastslidenum; i++) {
							chtml = '';							
							if(i==lastclickedpagenum){
								chtml ='current';
							}
							if(i-1==lastclickedpagenum || i+1==lastclickedpagenum || i==lastclickedpagenum){
							paginationhtml = paginationhtml +'<li><span class="brnprevclass wppro_page_numbers '+chtml+'">'+i+'</span></li>';
							}
						}
						//add dots if needed to end
						if((lastslidenum-lastclickedpagenum)>2){
							paginationhtml =  paginationhtml +'<li><span class="brnprevclass wppro_page_dots">…</span></li>';
						}
						//always add last page
						chtml ='';
						if(lastslidenum==lastclickedpagenum){
							chtml ='current';
						}
						
						paginationhtml =  paginationhtml +'<li><span class="brnprevclass wppro_page_numbers '+chtml+'">'+lastslidenum+'</span></li>';
						
						if(lastclickedpagenum!=lastslidenum){
							paginationhtml =  paginationhtml +'<li><span class="brnprevclass wppro_page_numbers">></span></li>';
						}
					}
					paginationhtml = paginationhtml +'</ul>'+spinner.get(0).outerHTML;
					
					console.log(spinner);
					
					//need to do a remove add instead of re
					$(parentdiv).html( paginationhtml );
				} else {
					//this must be a button instead of pagination, see if we should hide load more
					if(temptotalrevsindb <= tempreviewsperpage){
						//hide button
						$(parentdiv).hide();
					} else {
						$(parentdiv).show();
						$(parentdiv).find('.wprevpro_load_more_btn').show();
					}
				}

			} else {
				//console.log(data);
				spinner.hide();
			}
			
		}
			
		//for load more btn click, ajax more reviews and add to html
		$( ".wprevpro_load_more_btn" ).click(function(event) {
			loadmorerevs(this);
		});
		//console.log(wprevpublicjs_script_vars.wpfb_ajaxurl);
		function loadmorerevs(thebtn){
			//get number of review rows and per a row, use this number for offset call to db
			var spinner = $(thebtn).next( ".wprploadmore_loading_image" );
			var loadbtn = $(thebtn);
			//var templateiddiv = $(thebtn).closest('div');
			var numperrow = $(thebtn).attr('perrow');
			var numrows = $(thebtn).attr('nrows');
			var cnum = $(thebtn).attr('callnum');
			var revtemplateid = $(thebtn).attr('tid');
			var ismasonry = $(thebtn).attr('ismasonry');
			var isslider = $(thebtn).attr('slideshow');
			var notinstr = $(thebtn).attr('notinstring');
			
			var cpostid = $(thebtn).attr('cpostid');
			var shortcodepageid = $(thebtn).attr('shortcodepageid');
			var shortcodelang = $(thebtn).attr('shortcodelang');
			
			var revsameheight = $(thebtn).attr( "revsameheight" );
			
			if (/Mobi|Android/i.test(navigator.userAgent) || $(window).width()<600) {
				var oneonmobile = $(thebtn).attr( "onemobil" );
			} else {
				var oneonmobile = 'no';
			}
			
			//see if we have search text
			var searchtext = $(thebtn).closest('.wprevpro').prev('.wprev_search_sort_bar').find('.wprev_search').val();
			
			//see if we are overriding default sort
			var sorttext = $(thebtn).closest('.wprevpro').prev('.wprev_search_sort_bar').find('#wprevpro_header_sort').val();
			
			spinner.show();
			loadbtn.hide();

			//make ajax call
			 var senddata = {
				action: 'wprp_load_more_revs',	//required
				wpfb_nonce: wprevpublicjs_script_vars.wpfb_nonce,
				cache: false,
				processData : false,
				contentType : false,
				perrow: numperrow,
				nrows: numrows,
				callnum: cnum,
				notinstring:notinstr,
				revid: revtemplateid,
				onereview: oneonmobile,
				cpostid: cpostid,
				shortcodepageid: shortcodepageid,
				shortcodelang: shortcodelang,
				textsearch: searchtext,
				textsort: sorttext,
				};
				//send to ajax to update db
				var jqxhr = jQuery.post(wprevpublicjs_script_vars.wpfb_ajaxurl, senddata, function (data){
					var IS_JSON = true;
					console.log(data);
					//strip everything outside of {}, workaround when wordpress generates and message
					data = data.substring(0, data.indexOf('}')+1);
					try
					   {
							var jsondata = $.parseJSON(data);
					   }
					   catch(err)
					   {
						   IS_JSON = false;
							spinner.hide();
					   }  
					if(data && data!="" && IS_JSON){
						console.log(jsondata);
						var innerrevhtml = jsondata.innerhtml;
						var numreviews = jsondata.totalreviewsnum;
						var hideldbtn = jsondata.hideldbtn;
						var animateheight = jsondata.animateheight;
						//add to page
						if(isslider=='yes'){
							//add to btn slide
							loadbtn.parent('.wprevpro_load_more_div').before( innerrevhtml );
							if(hideldbtn!='yes'){
								//move btn slide to end
								var tempul = loadbtn.closest('li').next('li');
								var divtomove = loadbtn.parent('.wprevpro_load_more_div');
								divtomove.detach();
								tempul.append(divtomove);
							} else {
								loadbtn.closest('.wprs_unslider').find( "ol li:last").remove();
							}
							spinner.hide();
							//update slide height here if animateheight is true
							if(animateheight=='yes'){
								var liheight = $(thebtn ).closest('li').prev('li').css("height");
								$(thebtn ).closest( '.wprev-slider' ).animate({height: liheight,}, 750 );
								$(thebtn ).closest( '.wprev-slider-widget' ).animate({height: liheight,}, 750 );
							}
							//check to see if fixheight is set
							if(revsameheight=='yes'){
								checkfixheightslider(thebtn);
							}
							
						} else {
							if(ismasonry=='yes'){
								loadbtn.parent('.wprevpro_load_more_div').prev('.wprs_masonry').append( innerrevhtml );
							} else {
								loadbtn.parent('.wprevpro_load_more_div').before( innerrevhtml );
							}
							spinner.hide();
							if(numreviews>0){
								loadbtn.show();
							}
							if(hideldbtn=='yes'){
								loadbtn.hide();
							}
							if(revsameheight=='yes'){
								checkfixheightgrid(thebtn);
							}
						}
						//update btn attribute callnum
						var newcallnum = Number(jsondata.callnum) +1;
						var newnotinstring = jsondata.newnotinstring;
						loadbtn.attr('notinstring',newnotinstring);
						loadbtn.attr('callnum',newcallnum);
						loadbtn.attr('hideldbtn',hideldbtn);

					} else {
						//console.log(data);
						spinner.hide();
					}
				});
				jqxhr.fail(function() {
					  //display error message
						console.log("fail");
						spinner.hide();
						loadbtn.show();
				});
			
		}
		
		//when loading more for grid via button or page then we set height
		function checkfixheightgrid(thebtn){
			var maxheights = $(thebtn).closest( '.wprevpro' ).find(".w3_wprs-col").find("p").parent().map(function (){return $(this).outerHeight();}).get();
			var maxHeightofgrid = Math.max.apply(null, maxheights);
			$(thebtn).closest( '.wprevpro' ).find(".w3_wprs-col").find("p").parent().css( "height", maxHeightofgrid );
		}
		
		//when loading more, check to see if we are fixing the height, if so then set the height here
		function checkfixheightslider(thebtn){
			//wprs_unslider
			var maxheights = $(thebtn).closest( '.wprs_unslider' ).find(".w3_wprs-col").find("p").parent().map(function (){return $(this).outerHeight();}).get();
			var maxHeightofslide = Math.max.apply(null, maxheights);
			$(thebtn).closest( '.wprs_unslider' ).find(".w3_wprs-col").find("p").parent().css( "height", maxHeightofslide );
			
			//fix if the new height is bigger than overallheight
			var liheight = $(thebtn ).closest( 'li' ).prevAll( '.wprs_unslider-active' ).outerHeight();
			//find max height of all slides
			var heights = $(thebtn ).closest('.wprs_unslider').find( "li" ).map(function ()
						{
							return $(this).outerHeight();
						}).get(),overallheight = Math.max.apply(null, heights);
						
			if(liheight>overallheight){
				$(thebtn ).closest( '.wprevpro' ).animate({height: liheight,}, 200 );
			} else {
				$(thebtn ).closest( '.wprevpro' ).animate({height: overallheight,}, 200 );
			}
		}
		
		//for closing float on click
		$( ".wprev_pro_float_outerdiv-close" ).click(function(event) {
			$(this).closest('.wprevpro_float_outer').hide('300');
			//add to session storage so we don't show on page reload
			//sessionStorage.setItem('wprevpro_clickedclose', 'yes');
			var floatid = $(this).attr('id');
			
			//need to grab current settings first
			var wprevfloats = JSON.parse(sessionStorage.getItem("wprevfloats") || "[]");
			wprevfloats.push({id: floatid, clickedclose: "yes"});
			
			sessionStorage.setItem("wprevfloats", JSON.stringify(wprevfloats));
			//var clickedclose = sessionStorage.getItem('wprevpro_clickedclose');
		});
		
		//check to see if sessionStorage holds a clicked x then hide if so.
		checksession();
		function checksession(){
			//initially show all floats here
			$("div.wprevpro_float_outer").show();
			//check to see if any floats need to be hidden
			var wprevfloats = JSON.parse(sessionStorage.getItem("wprevfloats") || "[]");
			wprevfloats.forEach(function(wprevfloat, index) {
				if(wprevfloat.clickedclose=='yes' || wprevfloat.firstvisithide =='yes'){
					//hide the float here
					$( "#"+wprevfloat.id ).parent('.wprev_pro_float_outerdiv').hide();
				}
					//console.log("[" + index + "]: " + wprevfloat.id);
			});
			//update the storage if we are only displaying on first visit here
			$("div.wprevpro_badge_container[firstvisit='yes']").each(function( index ) {
				var floatid = $(this).find('.wprev_pro_float_outerdiv-close').attr('id');
				//only set if not set before
				var filtered=wprevfloats.filter(function(item){
					return item.firstvisithide=="yes";         
				});
				if (filtered.length < 1) {
					wprevfloats.push({id: floatid, firstvisithide: "yes"});
					sessionStorage.setItem("wprevfloats", JSON.stringify(wprevfloats));
				}
			});
			
		}
		
		//check to see if we are flying this float in and delay wprevpro_float_outer
		floatflyin();
		function floatflyin(){
			//get variables to see if we fly in or fade in
			var animatedir = $(".wprevpro_float_outer").find('.wprevpro_badge_container').attr('animatedir');
			var animatedelay = Number($(".wprevpro_float_outer").find(".wprevpro_badge_container").attr('animatedelay'))*1000;
			var floatdiv;
			var startcssval;

			if(animatedir=='right'){
				floatdiv = $(".wprevpro_float_outer").find(".wprev_pro_float_outerdiv");
				//fly this in from the right of the page
				startcssval = $(floatdiv).css("right");
				$(floatdiv).css("right", "-110%");
				if(animatedelay>0){
					setTimeout(function(){ $(floatdiv).animate({right: startcssval}, 1000 ); }, animatedelay);
				} else {
					$(floatdiv).animate({right: startcssval}, 1000 );
				}
			} else if(animatedir=='bottom'){
				floatdiv = $(".wprevpro_float_outer").find(".wprev_pro_float_outerdiv");
				//fly this in from the bottom of the page
				startcssval = $(floatdiv).css("bottom");
				$(floatdiv).css("bottom", "-110%");
				if(animatedelay>0){
					setTimeout(function(){ $(floatdiv).animate({bottom: startcssval}, 1000 ); }, animatedelay);
				} else {
					$(floatdiv).animate({bottom: startcssval}, 1000 );
				}
			} else if(animatedir=='left'){
				floatdiv = $(".wprevpro_float_outer").find(".wprev_pro_float_outerdiv");
				//fly this in from the left of the page
				startcssval = $(floatdiv).css("left");
				$(floatdiv).css("left", "-110%");
				if(animatedelay>0){
					setTimeout(function(){ $(floatdiv).animate({left: startcssval}, 1000 ); }, animatedelay);
				} else {
					$(floatdiv).animate({left: startcssval}, 1000 );
				}
			} else if(animatedir=='fade'){
				floatdiv = $(".wprevpro_float_outer").find(".wprev_pro_float_outerdiv");
				//fly this in from the left of the page
				startcssval = $(floatdiv).css("opacity");
				$(floatdiv).css("opacity", "0");
				if(animatedelay>0){
					setTimeout(function(){ $(floatdiv).animate({opacity: startcssval}, 1000 ); }, animatedelay);
				} else {
					$(floatdiv).animate({left: startcssval}, 1000 );
				}
			}
		}
		
		//check to see if we are auto-closing this float
		floatautoclose();
		function floatautoclose(){
			//get variables to see if we fly in or fade in
			var autoclose = $(".wprevpro_float_outer").find(".wprevpro_badge_container").attr('autoclose');
			var autoclosedelay = Number($(".wprevpro_float_outer").find(".wprevpro_badge_container").attr('autoclosedelay'))*1000;
			
			var floatdiv;
			var startcssval;
			
			if(autoclose=='yes' && autoclosedelay>0){
				floatdiv = $(".wprevpro_float_outer").find(".wprev_pro_float_outerdiv");
				//hide this
				setTimeout(function(){ $(floatdiv).hide(); }, autoclosedelay);
			}
		}
		
	
		
	});

})( jQuery );
