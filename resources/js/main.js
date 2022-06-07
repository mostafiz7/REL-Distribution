/* Custom-JS */

const Log = require("laravel-mix/src/Log");

(function($){
	"use strict";
	
	/*$(document).ready(function(){  });*/
	
	jQuery(document).ready(function($){
		
		// Show & Hide any html block
		$.fn.BlockVisible = function(selector){
			if( $(selector).hasClass("d-none") ){ $(selector).removeClass("d-none"); }
		}
		$.fn.BlockHidden = function(selector){
			if( ! $(selector).hasClass('d-none') ){ $(selector).addClass('d-none'); }
		};
		
		
		$(document).on('click', function(e){
			e = e || window.Event;
			let target = e.target || e.srcElement;
			let targetClass = target.classList;
			
			// Hide Accordion-Item Remove-Icon
			if( target.id !== "removeAccordionItem-btn" && (! targetClass.contains("remove-accordion-item") ) ){
				$("#Accordion-Parent .accordion-item .remove-accordion-item").each(function(){
					$.fn.BlockHidden($(this));
				});
			}
			
			// Hide Parts-List
			if( ! targetClass.contains("item_name") ){
				$.fn.BlockHidden(".parts-purchase #Vehicle-Parts-List");
			}
			
		});
		
		
		// Escape-Key & Tab-Key - Exit from any block / window
		// $(document).on('keyup', function(e){});
		$(document).on('keydown', function(e){
			if( e.key === "Escape" ){
				// Hide Parts-List
				$.fn.BlockHidden(".parts-purchase #Vehicle-Parts-List");
			}
			
			if( e.key === "Tab" ){
				// Hide Parts-List
				$.fn.BlockHidden(".parts-purchase #Vehicle-Parts-List");
			}
		});
		
		
		// Header Navbar
		// $("#SiteHeader .navbar-header .nav-link.dropdown-toggle");
		

		// Sidebar - Push-Menu
		$("#PushMenu").on("click", function(){
			if( ! $(this).hasClass("expanded") ){
				$(this).addClass("expanded");
				$("#Sidebar").addClass("expand");
				$(".sidebar-wrapper").removeClass("hidden");
				$("#SiteWrapper").addClass("expand");
				$("#Sidebar .logo-only").addClass("d-none");
				$("#Sidebar .logo-text").removeClass("d-none");
			} else{
				$(this).removeClass("expanded");
				$("#Sidebar").removeClass("expand");
				$(".sidebar-wrapper").addClass("hidden");
				$("#SiteWrapper").removeClass("expand");
				$("#Sidebar .logo-only").removeClass("d-none");
				$("#Sidebar .logo-text").addClass("d-none");
			}
		});
		$("#Sidebar").mouseover(function(){
			if( ! $("#PushMenu").hasClass("expanded") ){
				$(this).addClass("expand");
				$(".sidebar-wrapper").removeClass("hidden");
				$("#SiteWrapper").addClass("expand");
				$("#Sidebar .logo-only").addClass("d-none");
				$("#Sidebar .logo-text").removeClass("d-none");
			}
		});
		$("#Sidebar").mouseleave(function(){
			if( ! $("#PushMenu").hasClass("expanded") ){
				$(this).removeClass("expand");
				$(".sidebar-wrapper").addClass("hidden");
				$("#SiteWrapper").removeClass("expand");
				$("#Sidebar .logo-only").removeClass("d-none");
				$("#Sidebar .logo-text").addClass("d-none");
			}
		});


		// Dropdown menu toggle
		$(".dropmenu-toggle").each(function(){
			$(this).on('click', function(){
				$(this).toggleClass("active");
				$(this).next().toggleClass("show");

				/* if( ! $(this).hasClass("active") ){
					$(this).addClass("active");
					if( ! $(this).next().hasClass("show") ){
						$(this).next().addClass("show");
					}
				} else{
					$(this).removeClass("active");
					if( $(this).next().hasClass("show") ){
						$(this).next().removeClass("show");
					}
				} */

			});
		});

		
		// For Date-Picker
		$(".date-select .input-date").datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			showOtherMonths: true,
			selectOtherMonths: false,
			showAnim: "slideDown",
		});
		$(".date-select .input-date").datepicker().on("show", function(e){
			if( ! $("body").hasClass("datepicker-timepicker") ){
				$("body").addClass("datepicker-timepicker");
			}
		});
		$(".date-select .input-date").datepicker().on("hide", function(e){
			if( $("body").hasClass("datepicker-timepicker") ){
				$("body").removeClass("datepicker-timepicker");
			}
		});
		
		
		// Overlay-Scrollbar
		$('.overlay-scrollbar').overlayScrollbars({
			className: "os-theme-dark",
			scrollbars: {
				autoHide: "leave",
				autoHideDelay: 300,
				clickScrolling: true,
				snapHandle: true,
			},
			overflowBehavior: {
				x: "hidden"
			}
		});


		// Previous element width
		$(".full-width-prev-auto").each(function(){
			let prevWidth = $(this).prev().outerWidth();
			let prevML   	= $(this).prev().css('margin-left');
			let prevMR   	= $(this).prev().css('margin-right');
			let prevMLval = Number(prevML.replace(/[^0-9]/g, ''));
			let prevMRval = Number(prevMR.replace(/[^0-9]/g, ''));
			let prevWidthVal = (prevWidth + prevMLval + prevMRval);
			// let parentWidth = $(this).parent().innerWidth();
			let parentWidth = $(this).parent().width();
			// let parentPL 		= $(this).parent().css('padding-left'); // padding-left value
			// let parentPR 		= $(this).parent().css('padding-right'); // padding-right value
			let this_width  = (parentWidth - prevWidthVal - 5) + 'px';
			$(this).css('width', this_width);
		});


		// Previous element height
		$(".full-height-prev-auto").each(function(){
			let prevHeight   = $(this).prev().outerHeight();
			let parentHeight = $(this).parent().innerHeight();
			let this_height  = (parentHeight - prevHeight) + 'px';
			$(this).css('height', this_height);
		});


		$(".full-height-minus-prev-next").each(function(){
			let prevHeight   = $(this).prev().outerHeight();
			let nextHeight   = $(this).next().outerHeight();
			let parentHeight = $(this).parent().innerHeight();
			let this_height  = (parentHeight - prevHeight - nextHeight) + 'px';
			$(this).css('height', this_height);
		});


		// Set-Element-Height-by-Minus-Figured-Full-Height instead of calc(100% - minusPX);
		$('.full-height-minus').each(function(){
			let class_list = $(this).attr('class').split(/\s+/);
			let minusClassArr, parentHeight, this_height;
			$.each(class_list, function(index, item){
				if( item.indexOf('minus-') >= 0 ){
					minusClassArr = item.split('-');
				}
			});

			parentHeight = $(this).closest('.full-height-parent').innerHeight();
			// let parentHeight = $(this).closest('.full-height-parent').outerHeight();
			this_height = (parentHeight - Number(minusClassArr[1])) + 'px';
			$(this).css('height', this_height);
		});


		// Status Toggle Radio Button
		$("input[type=radio].status").on("click", function(){
			if( this.id === 'active' ){
				$(this).next().addClass('bg-success text-white fw-bold py-1 px-10');
				$("input[type=radio]#not-active").next().removeClass('bg-danger text-white fw-bold py-1 px-10');

				/* if( ! $(this).next().hasClass('bg-success text-white fw-bold py-1 px-10') ){
					$(this).next().addClass('bg-success text-white fw-bold py-1 px-10');
				} */
				/* if( $("input[type=radio]#not-active").next().hasClass('bg-danger text-white fw-bold py-1 px-10') ){
					$("input[type=radio]#not-active").next().removeClass('bg-danger text-white fw-bold py-1 px-10');
				} */
			}
			else if( this.id === 'not-active' ){
				$(this).next().addClass('bg-danger text-white fw-bold py-1 px-10');
				$("input[type=radio]#active").next().removeClass('bg-success text-white fw-bold py-1 px-10');

				/* if( ! $(this).next().hasClass('bg-danger text-white fw-bold py-1 px-10') ){
					$(this).next().addClass('bg-danger text-white fw-bold py-1 px-10');
				}
				if( $("input[type=radio]#active").next().hasClass('bg-success text-white fw-bold py-1 px-10') ){
					$("input[type=radio]#active").next().removeClass('bg-success text-white fw-bold py-1 px-10');
				} */
			}
		});


		// Show Password
		$(".show-password").on('click', function(){
			let password = $(this).prev()[0];
			let icon = $(this).children();
			if( password.type === 'password' ){
				password.type = 'text';
				$(this).removeClass('text-secondary');
				$(this).addClass('text-danger');
				icon.removeClass('fa-eye-slash');
				icon.addClass('fa-eye');
			} else{
				password.type = 'password';
				$(this).removeClass('text-danger');
				$(this).addClass('text-secondary');
				icon.removeClass('fa-eye');
				icon.addClass('fa-eye-slash');
			}
		});


		// Show Old-Password
		$(".show-old-password").on('click', function(){
			let password = $(this).prev()[0];
			let icon = $(this).children();
			if( password.type === 'password' ){
				password.type = 'text';
				$(this).removeClass('text-secondary');
				$(this).addClass('text-danger');
				icon.removeClass('fa-eye-slash');
				icon.addClass('fa-eye');
			} else{
				password.type = 'password';
				$(this).removeClass('text-danger');
				$(this).addClass('text-secondary');
				icon.removeClass('fa-eye');
				icon.addClass('fa-eye-slash');
			}
		});

		
		// Select-All Permissions
		$("input[type=checkbox].permission.select-all").on("click", function(){
			$("input[type=checkbox].permission").prop("checked", $(this).prop("checked"));
		});
		$("input[type=checkbox].permission").on("click", function(){
			if( ! $(this).prop("checked") ){
				$("input[type=checkbox].permission.select-all").prop("checked", false);
			}
		});
		
		
		// Select-All Routes
		$("input[type=checkbox].route.select-all").on("click", function(){
			$("input[type=checkbox].route").prop("checked", $(this).prop("checked"));
		});
		$("input[type=checkbox].route").on("click", function(){
			if( ! $(this).prop("checked") ){
				$("input[type=checkbox].route.select-all").prop("checked", false);
			}
		});
		
		
		// Select-All Route-Group
		/* $("input[type=checkbox].route-group.select-all").on("click", function(){
			$(this).parent().next().children(":first").prop("checked", $(this).prop("checked"));
			// $("input[type=checkbox].route").prop("checked", $(this).prop("checked"));
		});
		$("input[type=checkbox].route").on("click", function(){
			if( ! $(this).prop("checked") ){
				$(this).parent().prev().children(":first").prop("checked", false);
				// $("input[type=checkbox].route.select-all").prop("checked", false);
			}
		}); */



		
		
		
	
	});
}(jQuery));

