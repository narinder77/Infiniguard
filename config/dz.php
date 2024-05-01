<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Application Name
	|--------------------------------------------------------------------------
	|
	| This value is the name of your application. This value is used when the
	| framework needs to place the application's name in a notification or
	| any other location as required by the application or its packages.
	|
	*/

	'name' => env('APP_NAME', 'Vora Laravel'),


	'public' => [
		'global' => [
			'css' => [
				'/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
                //'/assets/vendor/datatables/css/jquery.dataTables.min.css',
				'/assets/css/datatables/dataTables.css',
				'/assets/css/style.css',
				'/assets/css/custom.css',

			],
			'js' => [
				'top'=> [
					'/assets/vendor/global/global.min.js',
					'/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
				],
				'bottom'=> [
					'/assets/js/custom.min.js',
					'/assets/js/dlabnav-init.js',
					'/assets/js/demo.js',
					'/assets/js/styleSwitcher.js',
					//'/assets/vendor/datatables/js/jquery.dataTables.min.js',
					'/assets/js/datatables/dataTables.js'
				],
			],
		],
		'pagelevel' => [
			'css' => [
				'VoraAdminController_dashboard_1' => [
					'/assets/vendor/chartist/css/chartist.min.css',
					'/assets/vendor/jqvmap/css/jqvmap.min.css',
					'/assets/vendor/owl-carousel/owl.carousel.css',
				],
				'VoraAdminController_dashboard_2' => [
					'/assets/vendor/chartist/css/chartist.min.css',
					'/assets/vendor/jqvmap/css/jqvmap.min.css',
					'/assets/vendor/owl-carousel/owl.carousel.css',
				],
				'VoraAdminController_projects' => [
					'/assets/vendor/chartist/css/chartist.min.css',
					'/assets/vendor/datatables/css/jquery.dataTables.min.css',
				],
				'VoraAdminController_contacts' => [
					'/assets/vendor/chartist/css/chartist.min.css'
				],
				'VoraAdminController_kanban' => [
					'/assets/vendor/chartist/css/chartist.min.css',
				],
				'VoraAdminController_calendar' => [
					'/assets/vendor/chartist/css/chartist.min.css',
					'/assets/vendor/datatables/css/jquery.dataTables.min.css',
					'/assets/vendor/fullcalendar-5.11.0/lib/main.css',
				],
				'VoraAdminController_messages' => [
					'/assets/vendor/chartist/css/chartist.min.css',
					'/assets/vendor/datatables/css/jquery.dataTables.min.css',
				],
				'VoraAdminController_app_calender' => [
					'/assets/vendor/fullcalendar-5.11.0/lib/main.css',
				],
				'VoraAdminController_app_profile' => [
					'/assets/vendor/lightgallery/css/lightgallery.min.css',
				],
				'VoraAdminController_edit_profile' => [
					'/assets/vendor/bootstrap-daterangepicker/daterangepicker.css',
					'/assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'/assets/vendor/jquery-nice-select/css/nice-select.css',
					'/assets/vendor/lightgallery/css/lightgallery.min.css',
					'https://fonts.googleapis.com/css2?family=Material+Icons',
				],
				'VoraAdminController_post_details' => [
					'/assets/vendor/lightgallery/css/lightgallery.min.css',
				],
				'VoraAdminController_chart_chartist' => [
					'/assets/vendor/chartist/css/chartist.min.css',
				],
				'VoraAdminController_chart_chartjs' => [
				],
				'VoraAdminController_chart_flot' => [

				],
				'VoraAdminController_chart_morris' => [
				],
				'VoraAdminController_chart_peity' => [
				],
				'VoraAdminController_chart_sparkline' => [
				],
				'VoraAdminController_ecom_checkout' => [
				],
				'VoraAdminController_ecom_customers' => [
				],
				'VoraAdminController_ecom_invoice' => [
				],
				'VoraAdminController_ecom_product_detail' => [
					'/assets/vendor/star-rating/star-rating-svg.css',
				],
				'VoraAdminController_ecom_product_grid' => [
				],
				'VoraAdminController_ecom_product_list' => [
					'/assets/vendor/star-rating/star-rating-svg.css',
				],
				'VoraAdminController_ecom_product_order' => [
				],
				'VoraAdminController_email_compose' => [
					'/assets/vendor/dropzone/dist/dropzone.css',
				],
				'VoraAdminController_email_inbox' => [
				],
				'VoraAdminController_email_read' => [
				],
				'VoraAdminController_form_ckeditor' => [
					'/assets/vendor/summernote/summernote.css',
				],
				'VoraAdminController_form_element' => [
				],
				'VoraAdminController_form_pickers' => [
					'/assets/vendor/bootstrap-daterangepicker/daterangepicker.css',
					'/assets/vendor/clockpicker/css/bootstrap-clockpicker.min.css',
					'/assets/vendor/jquery-asColorPicker/css/asColorPicker.min.css',
					'/assets/vendor/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
					'/assets/vendor/pickadate/themes/default.css',
					'/assets/vendor/pickadate/themes/default.date.css',
					'https://fonts.googleapis.com/icon?family=Material+Icons'
				],
				'VoraAdminController_form_validation_jquery' => [
				],
				'VoraAdminController_form_wizard' => [
					'/assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css',
				],
				'VoraAdminController_map_jqvmap' => [
					'/assets/vendor/jqvmap/css/jqvmap.min.css',
				],
				'VoraAdminController_table_bootstrap_basic' => [
				],
				'VoraAdminController_table_datatable_basic' => [
					'/assets/vendor/datatables/css/jquery.dataTables.min.css',
				],
				'VoraAdminController_uc_lightgallery' => [
					'/assets/vendor/lightgallery/css/lightgallery.min.css',
				],
				'VoraAdminController_uc_nestable' => [
					'/assets/vendor/nestable2/css/jquery.nestable.min.css',
				],
				'VoraAdminController_uc_noui_slider' => [
					'/assets/vendor/nouislider/nouislider.min.css',
				],
				'VoraAdminController_uc_select2' => [
					'/assets/vendor/select2/css/select2.min.css',
				],
				'VoraAdminController_uc_sweetalert' => [
					'/assets/vendor/sweetalert2/dist/sweetalert2.min.css',
				],
				'VoraAdminController_uc_toastr' => [
					'/assets/vendor/toastr/css/toastr.min.css',
				],
				'VoraAdminController_ui_accordion' => [
				],
				'VoraAdminController_ui_alert' => [
				],
				'VoraAdminController_ui_badge' => [
				],
				'VoraAdminController_ui_button' => [
				],
				'VoraAdminController_ui_button_group' => [
				],
				'VoraAdminController_ui_card' => [
				],
				'VoraAdminController_ui_carousel' => [
				],
				'VoraAdminController_ui_dropdown' => [
				],
				'VoraAdminController_ui_grid' => [
				],
				'VoraAdminController_ui_list_group' => [
				],
				'VoraAdminController_ui_media_object' => [
				],
				'VoraAdminController_ui_modal' => [
				],
				'VoraAdminController_ui_pagination' => [
				],
				'VoraAdminController_ui_popover' => [
				],
				'VoraAdminController_ui_progressbar' => [
				],
				'VoraAdminController_ui_tab' => [
				],
				'VoraAdminController_ui_typography' => [
				],
				'VoraAdminController_widget_basic' => [
					'/assets/vendor/chartist/css/chartist.min.css',
				],
			],
			'js' => [
				'VoraAdminController_dashboard_1' => [
					'/assets/vendor/chart.js/Chart.bundle.min.js',
					'/assets/vendor/owl-carousel/owl.carousel.js',
					'/assets/vendor/peity/jquery.peity.min.js',
					'/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js',
					'/assets/vendor/apexchart/apexchart.js',
					'/assets/js/dashboard/dashboard-1.js',
				],
				'VoraAdminController_dashboard_2' => [
					'/assets/vendor/chart.js/Chart.bundle.min.js',
					'/assets/vendor/owl-carousel/owl.carousel.js',
					'/assets/vendor/peity/jquery.peity.min.js',
					'/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js',
					'/assets/vendor/apexchart/apexchart.js',
					'/assets/js/dashboard/dashboard-1.js',
				],
				'VoraAdminController_projects' => [
					'/assets/vendor/chart.js/Chart.bundle.min.js',
					'/assets/vendor/datatables/js/jquery.dataTables.min.js',
				],
				'VoraAdminController_contacts' => [
					'/assets/vendor/chart.js/Chart.bundle.min.js',
				],
				'VoraAdminController_kanban' => [
					'/assets/vendor/chart.js/Chart.bundle.min.js',
					'/assets/vendor/draggable/draggable.js'
				],
				'VoraAdminController_calendar' => [
					'/assets/vendor/chart.js/Chart.bundle.min.js',
					'/assets/vendor/jqueryui/js/jquery-ui.min.js',
					'/assets/vendor/moment/moment.min.js',
					'/assets/vendor/fullcalendar-5.11.0/lib/main.min.js',
					'/assets/js/plugins-init/fullcalendar-init.js',
				],
				'VoraAdminController_messages' => [
					'/assets/vendor/chart.js/Chart.bundle.min.js',
				],
				'VoraAdminController_app_calender' => [
					'/assets/vendor/jqueryui/js/jquery-ui.min.js',
					'/assets/vendor/moment/moment.min.js',
					'/assets/vendor/fullcalendar-5.11.0/lib/main.js',
					'/assets/js/plugins-init/fullcalendar-init.js',
				],
				'VoraAdminController_app_profile' => [
					'/assets/vendor/lightgallery/js/lightgallery-all.min.js',
				],
				'VoraAdminController_edit_profile' => [
					'/assets/vendor/jquery-nice-select/js/jquery.nice-select.min.js',
					'/assets/vendor/moment/moment.min.js',
					'/assets/vendor/chart.js/Chart.bundle.min.js',
					'/assets/vendor/lightgallery/js/lightgallery-all.min.js',
					'/assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'/assets/js/plugins-init/material-date-picker-init.js',
				],
				'VoraAdminController_post_details' => [
					'/assets/vendor/lightgallery/js/lightgallery-all.min.js',
					'/assets/js/custom.js',
					'/assets/js/dlabnav-init.js',
				],
				'VoraAdminController_chart_chartist' => [
					'/assets/vendor/chartist/js/chartist.min.js',
					'/assets/vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'/assets/js/plugins-init/chartist-init.js',
				],
				'VoraAdminController_chart_chartjs' => [
					'/assets/vendor/chart.js/Chart.bundle.min.js',
					'/assets/js/plugins-init/chartjs-init.js',
				],
				'VoraAdminController_chart_flot' => [
					'/assets/vendor/flot/jquery.flot.js',
					'/assets/vendor/flot/jquery.flot.pie.js',
					'/assets/vendor/flot/jquery.flot.resize.js',
					'/assets/vendor/flot-spline/jquery.flot.spline.min.js',
					'/assets/js/plugins-init/flot-init.js',
				],
				'VoraAdminController_chart_morris' => [
					'/assets/vendor/raphael/raphael.min.js',
					'/assets/vendor/morris/morris.min.js',
					'/assets/js/plugins-init/morris-init.js',
				],
				'VoraAdminController_chart_peity' => [
					'/assets/vendor/peity/jquery.peity.min.js',
					'/assets/js/plugins-init/piety-init.js',

				],
				'VoraAdminController_chart_sparkline' => [
					'/assets/vendor/jquery-sparkline/jquery.sparkline.min.js',
					'/assets/js/plugins-init/sparkline-init.js',
				],
				'VoraAdminController_ecom_checkout' => [
					'/assets/vendor/highlightjs/highlight.pack.min.js',
				],
				'VoraAdminController_ecom_customers' => [
					'/assets/vendor/highlightjs/highlight.pack.min.js',
				],
				'VoraAdminController_ecom_invoice' => [
					'/assets/vendor/highlightjs/highlight.pack.min.js',
				],
				'VoraAdminController_ecom_product_detail' => [
					'/assets/vendor/highlightjs/highlight.pack.min.js',
					'/assets/vendor/star-rating/jquery.star-rating-svg.js',
				],
				'VoraAdminController_ecom_product_grid' => [
					'/assets/vendor/highlightjs/highlight.pack.min.js',
				],
				'VoraAdminController_ecom_product_list' => [
					'/assets/vendor/highlightjs/highlight.pack.min.js',
					'/assets/vendor/star-rating/jquery.star-rating-svg.js',
				],
				'VoraAdminController_ecom_product_order' => [
					'/assets/vendor/highlightjs/highlight.pack.min.js',
				],
				'VoraAdminController_email_compose' => [
					'/assets/vendor/dropzone/dist/dropzone.js',
				],
				'VoraAdminController_email_inbox' => [
				],
				'VoraAdminController_email_read' => [
				],
				'VoraAdminController_form_ckeditor' => [
					'/assets/vendor/ckeditor/ckeditor.js',
				],
				'VoraAdminController_form_element' => [
				],
				'VoraAdminController_form_pickers' => [
					'/assets/vendor/moment/moment.min.js',
					'/assets/vendor/bootstrap-daterangepicker/daterangepicker.js',
					'/assets/vendor/clockpicker/js/bootstrap-clockpicker.min.js',
					'/assets/vendor/jquery-asColor/jquery-asColor.min.js',
					'/assets/vendor/jquery-asGradient/jquery-asGradient.min.js',
					'/assets/vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js',
					'/assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
					'/assets/vendor/pickadate/picker.js',
					'/assets/vendor/pickadate/picker.time.js',
					'/assets/vendor/pickadate/picker.date.js',
					'/assets/js/plugins-init/bs-daterange-picker-init.js',
					'/assets/js/plugins-init/clock-picker-init.js',
					'/assets/js/plugins-init/jquery-asColorPicker.init.js',
					'/assets/js/plugins-init/material-date-picker-init.js',
					'/assets/js/plugins-init/pickadate-init.js',
				],
				'VoraAdminController_form_validation_jquery' => [
					'/assets/vendor/jquery-validation/jquery.validate.min.js',
					'/assets/js/plugins-init/jquery.validate-init.js',
				],
				'VoraAdminController_form_wizard' => [
					'/assets/vendor/jquery-validation/jquery.validate.min.js',
					'/assets/js/plugins-init/jquery.validate-init.js',
					'/assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js',
				],
				'VoraAdminController_map_jqvmap' => [
					'/assets/vendor/jqvmap/js/jquery.vmap.min.js',
					'/assets/vendor/jqvmap/js/jquery.vmap.world.js',
					'/assets/vendor/jqvmap/js/jquery.vmap.usa.js',
					'/assets/js/plugins-init/jqvmap-init.js',
				],
				'VoraAdminController_page_error_400' => [
				],
				'VoraAdminController_page_error_403' => [
				],
				'VoraAdminController_page_error_404' => [
				],
				'VoraAdminController_page_error_500' => [
				],
				'VoraAdminController_page_error_503' => [
				],
				'VoraAdminController_page_forgot_password' => [
				],
				'VoraAdminController_page_lock_screen' => [
					'/assets/vendor/dlabnav/dlabnav.min.js',
				],
				'VoraAdminController_page_login' => [
				],
				'VoraAdminController_page_register' => [
				],
				'VoraAdminController_table_bootstrap_basic' => [
				],
				'VoraAdminController_table_datatable_basic' => [
					'/assets/vendor/datatables/js/jquery.dataTables.min.js',
					'/assets/js/plugins-init/datatables.init.js',
				],
				'VoraAdminController_uc_lightgallery' => [
					'/assets/vendor/lightgallery/js/lightgallery-all.min.js',
				],
				'VoraAdminController_uc_nestable' => [
					'/assets/vendor/nestable2/js/jquery.nestable.min.js',
					'/assets/js/plugins-init/nestable-init.js',
				],
				'VoraAdminController_uc_noui_slider' => [
					'/assets/vendor/nouislider/nouislider.min.js',
					'/assets/vendor/wnumb/wNumb.js',
					'/assets/js/plugins-init/nouislider-init.js',
				],
				'VoraAdminController_uc_select2' => [
					'/assets/vendor/select2/js/select2.full.min.js',
					'/assets/js/plugins-init/select2-init.js',
				],
				'VoraAdminController_uc_sweetalert' => [
					'/assets/vendor/sweetalert2/dist/sweetalert2.min.js',
					'/assets/js/plugins-init/sweetalert.init.js',
				],
				'VoraAdminController_uc_toastr' => [
					'/assets/vendor/toastr/js/toastr.min.js',
					'/assets/js/plugins-init/toastr-init.js',
				],
				'VoraAdminController_ui_accordion' => [
				],
				'VoraAdminController_ui_alert' => [
				],
				'VoraAdminController_ui_badge' => [
				],
				'VoraAdminController_ui_button' => [
				],
				'VoraAdminController_ui_button_group' => [
				],
				'VoraAdminController_ui_card' => [
				],
				'VoraAdminController_ui_carousel' => [
				],
				'VoraAdminController_ui_dropdown' => [
				],
				'VoraAdminController_ui_grid' => [
				],
				'VoraAdminController_ui_list_group' => [
				],
				'VoraAdminController_ui_media_object' => [
				],
				'VoraAdminController_ui_modal' => [
				],
				'VoraAdminController_ui_pagination' => [
				],
				'VoraAdminController_ui_popover' => [
				],
				'VoraAdminController_ui_progressbar' => [
				],
				'VoraAdminController_ui_tab' => [
				],
				'VoraAdminController_ui_typography' => [
				],
				'VoraAdminController_widget_basic' => [
					'/assets/vendor/chartist/js/chartist.min.js',
					'/assets/vendor/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js',
					'/assets/vendor/flot/jquery.flot.js',
					'/assets/vendor/flot/jquery.flot.pie.js',
					'/assets/vendor/flot/jquery.flot.resize.js',
					'/assets/vendor/flot-spline/jquery.flot.spline.min.js',
					'/assets/vendor/jquery-sparkline/jquery.sparkline.min.js',
					'/assets/js/plugins-init/sparkline-init.js',
					'/assets/vendor/peity/jquery.peity.min.js',
					'/assets/js/plugins-init/piety-init.js',
					'/assets/vendor/chart.js/Chart.bundle.min.js',
					'/assets/js/plugins-init/widgets-script-init.js',
				]

			]
		],
	]
];
