<?php

use Illuminate\Support\Facades\View;

//admin index view
View::composer('administrator::index', function ($view) {
	//get a model instance that we'll use for constructing stuff
	$config = app('itemconfig');
	$fieldFactory = app('admin_field_factory');
	$columnFactory = app('admin_column_factory');
	$actionFactory = app('admin_action_factory');
	$dataTable = app('admin_datatable');
	$model = $config->getDataModel();
	$baseUrl = route('admin_dashboard', array(), false);
	$route = parse_url($baseUrl);

	//add the view fields
	$view->config = $config;
	$view->dataTable = $dataTable;
	$view->primaryKey = $model->getKeyName();
	$view->editFields = $fieldFactory->getEditFields();
	$view->arrayFields = $fieldFactory->getEditFieldsArrays();
	$view->dataModel = $fieldFactory->getDataModel();
	$view->columnModel = $columnFactory->getColumnOptions();
	$view->actions = $actionFactory->getActionsOptions();
	$view->globalActions = $actionFactory->getGlobalActionsOptions();
	$view->actionPermissions = $actionFactory->getActionPermissions();
	$view->filters = $fieldFactory->getFiltersArrays();
	$view->rows = $dataTable->getRows(app('db'), $view->filters);
	$view->formWidth = $config->getOption('form_width');
	$view->baseUrl = $baseUrl;
	$view->assetUrl = url('packages/frozennode/administrator/');
	$view->route = $route['path'] . '/';
	$view->itemId = $view->itemId ?? null;
});

//admin settings view
View::composer('administrator::settings', function ($view) {
	$config = app('itemconfig');
	$fieldFactory = app('admin_field_factory');
	$actionFactory = app('admin_action_factory');
	$baseUrl = route('admin_dashboard', array(), false);
	$route = parse_url($baseUrl);

	//add the view fields
	$view->config = $config;
	$view->editFields = $fieldFactory->getEditFields();
	$view->arrayFields = $fieldFactory->getEditFieldsArrays();
	$view->actions = $actionFactory->getActionsOptions();
	$view->baseUrl = $baseUrl;
	$view->assetUrl = url('packages/frozennode/administrator/');
	$view->route = $route['path'] . '/';
});

//header view
View::composer(array('administrator::partials.header'), function ($view) {
	$view->menu = app('admin_menu')->getMenu();
	$view->settingsPrefix = app('admin_config_factory')->getSettingsPrefix();
	$view->pagePrefix = app('admin_config_factory')->getPagePrefix();
	$view->routePrefix = app('admin_config_factory')->getRoutePrefix();
	$view->configType = app()->bound('itemconfig') ? app('itemconfig')->getType() : false;
});

//the layout view
View::composer(array('administrator::layouts.default'), function ($view) {

	$secureAssets = config('administrator.force_https_assets') ? true : null;

	//set up the basic asset arrays
	$view->css = array();
	$view->js = array(
		'jquery' => asset('packages/frozennode/administrator/js/jquery/jquery-1.8.2.min.js', $secureAssets),
		'jquery-ui' => asset('packages/frozennode/administrator/js/jquery/jquery-ui-1.10.3.custom.min.js', $secureAssets),
		'customscroll' => asset('packages/frozennode/administrator/js/jquery/customscroll/jquery.customscroll.js', $secureAssets),
	);

	//add the non-custom-page css assets
	if (!$view->page && !$view->dashboard) {
		$view->css += array(
			'jquery-ui' => asset('packages/frozennode/administrator/css/ui/jquery-ui-1.9.1.custom.min.css', $secureAssets),
			'jquery-ui-timepicker' => asset('packages/frozennode/administrator/css/ui/jquery.ui.timepicker.css', $secureAssets),
			'select2' => asset('packages/frozennode/administrator/js/jquery/select2/select2.css', $secureAssets),
			'jquery-colorpicker' => asset('packages/frozennode/administrator/css/jquery.lw-colorpicker.css', $secureAssets),
		);
	}

	//add the package-wide css assets
	$view->css += array(
		'customscroll' => asset('packages/frozennode/administrator/js/jquery/customscroll/customscroll.css', $secureAssets),
		'main' => asset('packages/frozennode/administrator/css/main.css', $secureAssets),
	);

	//add the non-custom-page js assets
	if (!$view->page && !$view->dashboard) {
		$view->js += array(
			'select2' => asset('packages/frozennode/administrator/js/jquery/select2/select2.js', $secureAssets),
			'jquery-ui-timepicker' => asset('packages/frozennode/administrator/js/jquery/jquery-ui-timepicker-addon.js', $secureAssets),
			'ckeditor' => asset('packages/frozennode/administrator/js/ckeditor/ckeditor.js', $secureAssets),
			'ckeditor-jquery' => asset('packages/frozennode/administrator/js/ckeditor/adapters/jquery.js', $secureAssets),
			'markdown' => asset('packages/frozennode/administrator/js/markdown.js', $secureAssets),
			'plupload' => asset('packages/frozennode/administrator/js/plupload/js/plupload.full.js', $secureAssets),
		);

		//localization js assets
		$locale = config('app.locale');

		if ($locale !== 'en') {
			$view->js += array(
				'plupload-l18n' => asset('packages/frozennode/administrator/js/plupload/js/i18n/' . $locale . '.js', $secureAssets),
				'timepicker-l18n' => asset('packages/frozennode/administrator/js/jquery/localization/jquery-ui-timepicker-' . $locale . '.js', $secureAssets),
				'datepicker-l18n' => asset('packages/frozennode/administrator/js/jquery/i18n/jquery.ui.datepicker-' . $locale . '.js', $secureAssets),
				'select2-l18n' => asset('packages/frozennode/administrator/js/jquery/select2/select2_locale_' . $locale . '.js', $secureAssets),
			);
		}

		//remaining js assets
		$view->js += array(
			'knockout' => asset('packages/frozennode/administrator/js/knockout/knockout-2.2.0.js', $secureAssets),
			'knockout-mapping' => asset('packages/frozennode/administrator/js/knockout/knockout.mapping.js', $secureAssets),
			'knockout-notification' => asset('packages/frozennode/administrator/js/knockout/KnockoutNotification.knockout.min.js', $secureAssets),
			'knockout-update-data' => asset('packages/frozennode/administrator/js/knockout/knockout.updateData.js', $secureAssets),
			'knockout-custom-bindings' => asset('packages/frozennode/administrator/js/knockout/custom-bindings.js', $secureAssets),
			'accounting' => asset('packages/frozennode/administrator/js/accounting.js', $secureAssets),
			'colorpicker' => asset('packages/frozennode/administrator/js/jquery/jquery.lw-colorpicker.min.js', $secureAssets),
			'history' => asset('packages/frozennode/administrator/js/history/native.history.js', $secureAssets),
			'admin' => asset('packages/frozennode/administrator/js/admin.js', $secureAssets),
			'settings' => asset('packages/frozennode/administrator/js/settings.js', $secureAssets),
		);
	}

	$view->js += array('page' => asset('packages/frozennode/administrator/js/page.js', $secureAssets));
});
