
(function( $ ) {
	wp.customize.bind( 'ready', function() {

		var optPrefix = '#customize-control-uni_course_options-';
		
		// Label
		function uni_course_customizer_label( id, title ) {

			// General Setting

			if ( id === 'uni_course_preloader_hide' || id === 'uni_course_sticky_header' || id === 'uni_course_scroll_hide' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Colors

			if ( id === 'uni_course_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Top Header

			if ( id === 'uni_course_ticket_text' || id === 'uni_course_phone_number' || id === 'uni_course_email' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header

			if ( id === 'uni_course_search_on_off' || id === 'uni_course_consultation_button1' || id === 'uni_course_consultation_button2' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			
			// Social Icon

			if ( id === 'uni_course_facebook_icon' || id === 'uni_course_twitter_icon' || id === 'uni_course_instagram_icon'|| id === 'uni_course_linkedin_icon'|| id === 'uni_course_pinterest_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'uni_course_top_slider_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
			// Online Lessons

			if ( id === 'uni_course_other_project_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'uni_course_footer_text_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-uni_course_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}

		// General Setting
		uni_course_customizer_label( 'uni_course_preloader_hide', 'Preloader' );
		uni_course_customizer_label( 'uni_course_sticky_header', 'Sticky Header' );
		uni_course_customizer_label( 'uni_course_scroll_hide', 'Scroll To Top' );


		// Colors
		uni_course_customizer_label( 'uni_course_theme_color', 'Theme Color' );
		uni_course_customizer_label( 'background_color', 'Colors' );
		uni_course_customizer_label( 'background_image', 'Image' );

		// Site Identity
		uni_course_customizer_label( 'custom_logo', 'Logo Setup' );
		uni_course_customizer_label( 'site_icon', 'Favicon' );

		//Header Image
		uni_course_customizer_label( 'header_image', 'Header Image' );

		// Top Header
		uni_course_customizer_label( 'uni_course_ticket_text', 'Ticket Text' );
		uni_course_customizer_label( 'uni_course_phone_number', 'Phone' );
		uni_course_customizer_label( 'uni_course_email', 'Email' );

		// Header
		uni_course_customizer_label( 'uni_course_search_on_off', 'Search' );
		uni_course_customizer_label( 'uni_course_consultation_button1', 'Button 1' );
		uni_course_customizer_label( 'uni_course_consultation_button2', 'Button 2' );

		
		// Social Icon
		uni_course_customizer_label( 'uni_course_facebook_icon', 'Facebook' );
		uni_course_customizer_label( 'uni_course_twitter_icon', 'Twitter' );
		uni_course_customizer_label( 'uni_course_instagram_icon', 'Intagram' );
		uni_course_customizer_label( 'uni_course_linkedin_icon', 'Linkedin' );
		uni_course_customizer_label( 'uni_course_pinterest_icon', 'Pintrest' );

		//Slider
		uni_course_customizer_label( 'uni_course_top_slider_setting', 'Slider' );

		//Online Lessons
		uni_course_customizer_label( 'uni_course_other_project_setting', 'Online Lessons' );

		//Footer
		uni_course_customizer_label( 'uni_course_footer_text_setting', 'Footer' );
	

	}); 

})( jQuery );
