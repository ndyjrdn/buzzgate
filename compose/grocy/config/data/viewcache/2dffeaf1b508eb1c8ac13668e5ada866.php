<?php global $GROCY_REQUIRED_FRONTEND_PACKAGES; ?>

<!DOCTYPE html>
<html lang="<?php echo e(GROCY_LOCALE); ?>"
	dir="<?php echo e($dir); ?>">

<head>
	<meta charset="utf-8">
	<meta name="viewport"
		content="width=device-width, initial-scale=1">
	<meta name="robots"
		content="noindex,nofollow">

	<link rel="icon"
		type="image/png"
		sizes="32x32"
		href="<?php echo e($U('/img/icon-32.png?v=', true)); ?><?php echo e($version); ?>">

	<?php if(GROCY_AUTHENTICATED): ?>
	<link rel="manifest"
		crossorigin="use-credentials"
		href="<?php echo e($U('/manifest') . '?data=' . base64_encode($__env->yieldContent('title') . '#' . $U($_SERVER['REQUEST_URI']))); ?>">
	<?php endif; ?>

	<title><?php echo $__env->yieldContent('title'); ?> | Grocy</title>

	<link href="<?php echo e($U('/packages/@fontsource/roboto/400.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/@fontsource/roboto/500.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/@fontsource/roboto/700.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/bootstrap/dist/css/bootstrap.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/@fortawesome/fontawesome-free/css/fontawesome.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/@fortawesome/fontawesome-free/css/solid.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/toastr/build/toastr.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">

	<?php if(in_array('bootstrap-combobox', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<link href="<?php echo e($U('/packages/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>
	<?php if(in_array('bootstrap-select', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<link href="<?php echo e($U('/packages/bootstrap-select/dist/css/bootstrap-select.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>
	<?php if(in_array('datatables', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<link href="<?php echo e($U('/packages/datatables.net-bs4/css/dataTables.bootstrap4.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/datatables.net-colreorder-bs4/css/colReorder.bootstrap4.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/datatables.net-rowgroup-bs4/css/rowGroup.bootstrap4.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/packages/datatables.net-select-bs4/css/select.bootstrap4.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>
	<?php if(in_array('tempusdominus', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<link href="<?php echo e($U('/packages/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>
	<?php if(in_array('summernote', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<link href="<?php echo e($U('/packages/summernote/dist/summernote-bs4.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>
	<?php if(in_array('animatecss', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<link href="<?php echo e($U('/packages/animate.css/animate.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>
	<?php if(in_array('fullcalendar', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<link href="<?php echo e($U('/packages/fullcalendar/dist/fullcalendar.min.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>
	<?php if(in_array('daterangepicker', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<link href="<?php echo e($U('/packages/daterangepicker/daterangepicker.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>

	<link href="<?php echo e($U('/css/grocy_menu_layout.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<link href="<?php echo e($U('/css/grocy.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">

	<?php if(boolval($userSettings['night_mode_enabled_internal'])): ?>
	<link id="night-mode-stylesheet"
		href="<?php echo e($U('/css/grocy_night_mode.css?v=', true)); ?><?php echo e($version); ?>"
		rel="stylesheet">
	<?php endif; ?>

	<?php echo $__env->yieldPushContent('pageStyles'); ?>

	<?php if(file_exists(GROCY_DATAPATH . '/custom_css.html')): ?>
	<?php include GROCY_DATAPATH . '/custom_css.html' ?>
	<?php endif; ?>
	<script>
		var Grocy = { };
		Grocy.Components = { };
		Grocy.Mode = '<?php echo e(GROCY_MODE); ?>';
		Grocy.BaseUrl = '<?php echo e($U('/')); ?>';
		Grocy.CurrentUrlRelative = "/" + window.location.href.split('?')[0].replace(Grocy.BaseUrl, "");
		Grocy.View = '<?php echo e($viewName); ?>';
		Grocy.Currency = '<?php echo e(GROCY_CURRENCY); ?>';
		Grocy.EnergyUnit = '<?php echo e(GROCY_ENERGY_UNIT); ?>';
		Grocy.CalendarFirstDayOfWeek = '<?php echo e(GROCY_CALENDAR_FIRST_DAY_OF_WEEK); ?>';
		Grocy.CalendarShowWeekNumbers = <?php echo e(BoolToString(GROCY_CALENDAR_SHOW_WEEK_OF_YEAR)); ?>;
		Grocy.LocalizationStrings = <?php echo $LocalizationStrings; ?>;
		Grocy.LocalizationStringsQu = <?php echo $LocalizationStringsQu; ?>;
		Grocy.FeatureFlags = <?php echo json_encode($featureFlags); ?>;
		Grocy.Webhooks = {
		<?php if(GROCY_FEATURE_FLAG_LABEL_PRINTER && !GROCY_LABEL_PRINTER_RUN_SERVER): ?>
			"labelprinter" : {
				"hook": "<?php echo e(GROCY_LABEL_PRINTER_WEBHOOK); ?>",
				"extra_data": <?php echo json_encode(GROCY_LABEL_PRINTER_PARAMS); ?>,
				"json": <?php echo e(BoolToString(GROCY_LABEL_PRINTER_HOOK_JSON)); ?>

			}
		<?php endif; ?>
		};

		<?php if(GROCY_AUTHENTICATED): ?>
		Grocy.UserSettings = <?php echo json_encode($userSettings); ?>;
		Grocy.UserId = <?php echo e(GROCY_USER_ID); ?>;
		Grocy.UserPermissions = <?php echo json_encode($permissions); ?>;
		<?php else: ?>
		Grocy.UserSettings = { };
		Grocy.UserId = -1;
		<?php endif; ?>
	</script>
</head>

<body class="fixed-nav <?php if(boolval($userSettings['night_mode_enabled_internal'])): ?> night-mode <?php endif; ?> <?php if($embedded): ?> embedded <?php endif; ?>">
	<?php if(!$embedded): ?>
	<nav id="mainNav"
		class="navbar navbar-expand-lg navbar-light fixed-top">
		<a class="navbar-brand py-0"
			href="<?php echo e($U('/')); ?>">
			<img src="<?php echo e($U('/img/logo.svg?v=', true)); ?><?php echo e($version); ?>"
				width="114"
				height="30">
		</a>
		<span id="clock-container"
			class="text-muted font-italic d-none">
			<i class="fa-solid fa-clock"></i>
			<span id="clock-small"
				class="d-inline d-sm-none"></span>
			<span id="clock-big"
				class="d-none d-sm-inline"></span>
		</span>

		<?php if(GROCY_AUTHENTICATED): ?>
		<button class="navbar-toggler navbar-toggler-right"
			type="button"
			data-toggle="collapse"
			data-target="#sidebarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div id="sidebarResponsive"
			class="collapse navbar-collapse">
			<ul class="navbar-nav navbar-sidenav">

				<?php if(GROCY_FEATURE_FLAG_STOCK): ?>
				<li class="nav-item nav-item-sidebar <?php if($viewName == 'stockoverview'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Stock overview')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/stockoverview')); ?>">
						<i class="fa-solid fa-fw fa-box"></i>
						<span class="nav-link-text"><?php echo e($__t('Stock overview')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_SHOPPINGLIST): ?>
				<li class="nav-item nav-item-sidebar <?php if($viewName == 'shoppinglist'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Shopping list')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/shoppinglist')); ?>">
						<i class="fa-solid fa-fw fa-shopping-cart"></i>
						<span class="nav-link-text"><?php echo e($__t('Shopping list')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_RECIPES): ?>
				<div class="nav-item-divider"></div>
				<li class="nav-item nav-item-sidebar permission-RECIPES <?php if($viewName == 'recipes'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Recipes')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/recipes')); ?>">
						<i class="fa-solid fa-fw fa-pizza-slice"></i>
						<span class="nav-link-text"><?php echo e($__t('Recipes')); ?></span>
					</a>
				</li>
				<?php if(GROCY_FEATURE_FLAG_RECIPES_MEALPLAN): ?>
				<li class="nav-item nav-item-sidebar permission-RECIPES_MEALPLAN <?php if($viewName == 'mealplan'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Meal plan')); ?>">
					<a id="meal-plan-nav-link"
						class="nav-link discrete-link"
						href="<?php echo e($U('/mealplan')); ?>">
						<i class="fa-solid fa-fw fa-paper-plane"></i>
						<span class="nav-link-text"><?php echo e($__t('Meal plan')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_CHORES): ?>
				<div class="nav-item-divider"></div>
				<li class="nav-item nav-item-sidebar <?php if($viewName == 'choresoverview'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Chores overview')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/choresoverview')); ?>">
						<i class="fa-solid fa-fw fa-home"></i>
						<span class="nav-link-text"><?php echo e($__t('Chores overview')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_TASKS): ?>
				<li class="nav-item nav-item-sidebar <?php if($viewName == 'tasks'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Tasks')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/tasks')); ?>">
						<i class="fa-solid fa-fw fa-tasks"></i>
						<span class="nav-link-text"><?php echo e($__t('Tasks')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_BATTERIES): ?>
				<li class="nav-item nav-item-sidebar <?php if($viewName == 'batteriesoverview'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Batteries overview')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/batteriesoverview')); ?>">
						<i class="fa-solid fa-fw fa-battery-half"></i>
						<span class="nav-link-text"><?php echo e($__t('Batteries overview')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_EQUIPMENT): ?>
				<li class="nav-item nav-item-sidebar permission-EQUIPMENT <?php if($viewName == 'equipment'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Equipment')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/equipment')); ?>">
						<i class="fa-solid fa-fw fa-toolbox"></i>
						<span class="nav-link-text"><?php echo e($__t('Equipment')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_CALENDAR): ?>
				<div class="nav-item-divider"></div>
				<li class="nav-item nav-item-sidebar permission-CALENDAR <?php if($viewName == 'calendar'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Calendar')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/calendar')); ?>">
						<i class="fa-solid fa-fw fa-calendar-days"></i>
						<span class="nav-link-text"><?php echo e($__t('Calendar')); ?></span>
					</a>
				</li>
				<?php endif; ?>

				<?php if(GROCY_FEATURE_FLAG_STOCK): ?>
				<div class="nav-item-divider"></div>
				<li class="nav-item nav-item-sidebar permission-STOCK_PURCHASE <?php if($viewName == 'purchase'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Purchase')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/purchase')); ?>">
						<i class="fa-solid fa-fw fa-cart-plus"></i>
						<span class="nav-link-text"><?php echo e($__t('Purchase')); ?></span>
					</a>
				</li>
				<li class="nav-item nav-item-sidebar permission-STOCK_CONSUME <?php if($viewName == 'consume'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Consume')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/consume')); ?>">
						<i class="fa-solid fa-fw fa-utensils"></i>
						<span class="nav-link-text"><?php echo e($__t('Consume')); ?></span>
					</a>
				</li>
				<?php if(GROCY_FEATURE_FLAG_STOCK_LOCATION_TRACKING): ?>
				<li class="nav-item nav-item-sidebar permission-STOCK_TRANSFER <?php if($viewName == 'transfer'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Transfer')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/transfer')); ?>">
						<i class="fa-solid fa-fw fa-exchange-alt"></i>
						<span class="nav-link-text"><?php echo e($__t('Transfer')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<li class="nav-item nav-item-sidebar permission-STOCK_INVENTORY <?php if($viewName == 'inventory'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Inventory')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/inventory')); ?>">
						<i class="fa-solid fa-fw fa-list"></i>
						<span class="nav-link-text"><?php echo e($__t('Inventory')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_CHORES): ?>
				<li class="nav-item nav-item-sidebar permission-CHORE_TRACK_EXECUTION <?php if($viewName == 'choretracking'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Chore tracking')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/choretracking')); ?>">
						<i class="fa-solid fa-fw fa-play"></i>
						<span class="nav-link-text"><?php echo e($__t('Chore tracking')); ?></span>
					</a>
				</li>
				<?php endif; ?>
				<?php if(GROCY_FEATURE_FLAG_BATTERIES): ?>
				<li class="nav-item nav-item-sidebar permission-BATTERIES_TRACK_CHARGE_CYCLE <?php if($viewName == 'batterytracking'): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Battery tracking')); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/batterytracking')); ?>">
						<i class="fa-solid fa-fw fa-car-battery"></i>
						<span class="nav-link-text"><?php echo e($__t('Battery tracking')); ?></span>
					</a>
				</li>
				<?php endif; ?>

				<?php $firstUserentity = true; ?>
				<?php $__currentLoopData = $userentitiesForSidebar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userentity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($firstUserentity): ?>
				<div class="nav-item-divider"></div>
				<?php $firstUserentity = false; ?>
				<?php endif; ?>
				<li class="nav-item nav-item-sidebar <?php if($viewName == 'userobjects' && $__env->yieldContent('title') == $userentity->caption): ?> active-page <?php endif; ?>"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($userentity->caption); ?>">
					<a class="nav-link discrete-link"
						href="<?php echo e($U('/userobjects/' . $userentity->name)); ?>">
						<i class="fa-fw <?php echo e($userentity->icon_css_class); ?>"></i>
						<span class="nav-link-text"><?php echo e($userentity->caption); ?></span>
					</a>
				</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				<?php
				$masterDataViews = [
				'products', 'locations', 'shoppinglocations', 'quantityunits',
				'productgroups', 'chores', 'batteries', 'taskcategories',
				'userfields', 'userentities'
				]
				?>
				<div class="nav-item-divider"></div>
				<li class="nav-item nav-item-sidebar"
					data-toggle="tooltip"
					data-placement="right"
					title="<?php echo e($__t('Manage master data')); ?>">
					<a class="nav-link nav-link-collapse discrete-link <?php if(!in_array($viewName, $masterDataViews)): ?> collapsed <?php else: ?> active-page <?php endif; ?>"
						data-toggle="collapse"
						href="#sub-nav-manage-master-data">
						<i class="fa-solid fa-fw fa-table"></i>
						<span class="nav-link-text"><?php echo e($__t('Manage master data')); ?></span>
					</a>
					<ul id="sub-nav-manage-master-data"
						class="sidenav-second-level collapse <?php if(in_array($viewName, $masterDataViews)): ?> show <?php endif; ?>">
						<li class="<?php if($viewName == 'products'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/products')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Products')); ?></span>
							</a>
						</li>
						<?php if(GROCY_FEATURE_FLAG_STOCK): ?>
						<?php if(GROCY_FEATURE_FLAG_STOCK_LOCATION_TRACKING): ?>
						<li class="<?php if($viewName == 'locations'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/locations')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Locations')); ?></span>
							</a>
						</li>
						<?php endif; ?>
						<?php if(GROCY_FEATURE_FLAG_STOCK_PRICE_TRACKING): ?>
						<li class="<?php if($viewName == 'shoppinglocations'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/shoppinglocations')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Stores')); ?></span>
							</a>
						</li>
						<?php endif; ?>
						<?php endif; ?>
						<li class="<?php if($viewName == 'quantityunits'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/quantityunits')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Quantity units')); ?></span>
							</a>
						</li>
						<li class="<?php if($viewName == 'productgroups'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/productgroups')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Product groups')); ?></span>
							</a>
						</li>
						<?php if(GROCY_FEATURE_FLAG_CHORES): ?>
						<li class="<?php if($viewName == 'chores'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/chores')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Chores')); ?></span>
							</a>
						</li>
						<?php endif; ?>
						<?php if(GROCY_FEATURE_FLAG_BATTERIES): ?>
						<li class="<?php if($viewName == 'batteries'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/batteries')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Batteries')); ?></span>
							</a>
						</li>
						<?php endif; ?>
						<?php if(GROCY_FEATURE_FLAG_TASKS): ?>
						<li class="<?php if($viewName == 'taskcategories'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/taskcategories')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Task categories')); ?></span>
							</a>
						</li>
						<?php endif; ?>
						<li class="<?php if($viewName == 'userfields'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/userfields')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Userfields')); ?></span>
							</a>
						</li>
						<li class="<?php if($viewName == 'userentities'): ?> active-page <?php endif; ?>">
							<a class="nav-link discrete-link"
								href="<?php echo e($U('/userentities')); ?>">
								<span class="nav-link-text"><?php echo e($__t('Userentities')); ?></span>
							</a>
						</li>
					</ul>
				</li>
			</ul>

			<ul class="navbar-nav sidenav-toggler">
				<li class="nav-item">
					<a id="sidenavToggler"
						class="nav-link text-center">
						<i class="fa-solid fa-angle-left"></i>
					</a>
				</li>
			</ul>

			<ul class="navbar-nav ml-auto">
				<?php if(GROCY_AUTHENTICATED && !GROCY_IS_EMBEDDED_INSTALL && !GROCY_DISABLE_AUTH): ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle discrete-link <?php if(!empty(GROCY_USER_PICTURE_FILE_NAME)): ?> py-0 <?php endif; ?>"
						href="#"
						data-toggle="dropdown">
						<?php if(empty(GROCY_USER_PICTURE_FILE_NAME)): ?>
						<i class="fa-solid fa-user"></i>
						<?php else: ?>
						<img class="rounded-circle"
							src="<?php echo e($U('/files/userpictures/' . base64_encode(GROCY_USER_PICTURE_FILE_NAME) . '_' . base64_encode(GROCY_USER_PICTURE_FILE_NAME) . '?force_serve_as=picture&best_fit_width=32&best_fit_height=32')); ?>"
							loading="lazy">
						<?php endif; ?>
						<?php echo e(GROCY_USER_USERNAME); ?>

					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item logout-button discrete-link"
							href="<?php echo e($U('/logout')); ?>"><i class="fa-solid fa-fw fa-sign-out-alt"></i>&nbsp;<?php echo e($__t('Logout')); ?></a>
						<div class="dropdown-divider"></div>
						<?php if(!defined('GROCY_EXTERNALLY_MANAGED_AUTHENTICATION')): ?>
						<a class="dropdown-item logout-button discrete-link"
							href="<?php echo e($U('/user/' . GROCY_USER_ID . '?changepw=true')); ?>"><i class="fa-solid fa-fw fa-key"></i>&nbsp;<?php echo e($__t('Change password')); ?></a>
						<?php else: ?>
						<a class="dropdown-item logout-button discrete-link"
							href="<?php echo e($U('/user/' . GROCY_USER_ID)); ?>"><i class="fa-solid fa-fw fa-key"></i>&nbsp;<?php echo e($__t('Edit user')); ?></a>
						<?php endif; ?>
					</div>
				</li>
				<?php endif; ?>

				<?php if(GROCY_AUTHENTICATED): ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle discrete-link"
						href="#"
						data-toggle="dropdown"><i class="fa-solid fa-sliders-h"></i> <span class="d-inline d-lg-none"><?php echo e($__t('View settings')); ?></span></a>

					<div class="dropdown-menu dropdown-menu-right">
						<div class="dropdown-item">
							<div class="form-check">
								<input class="form-check-input user-setting-control"
									type="checkbox"
									id="auto-reload-enabled"
									data-setting-key="auto_reload_on_db_change">
								<label class="form-check-label"
									for="auto-reload-enabled">
									<?php echo e($__t('Auto reload on external changes')); ?>

								</label>
							</div>
						</div>
						<div class="dropdown-item">
							<div class="form-check">
								<input class="form-check-input user-setting-control"
									type="checkbox"
									id="show-clock-in-header"
									data-setting-key="show_clock_in_header">
								<label class="form-check-label"
									for="show-clock-in-header">
									<?php echo e($__t('Show clock in header')); ?>

								</label>
							</div>
						</div>
						<div class="dropdown-divider"></div>
						<div class="dropdown-item pt-0">
							<div>
								<?php echo e($__t('Night mode')); ?>

							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input class="custom-control-input user-setting-control"
									type="radio"
									name="night-mode"
									id="night-mode-on"
									value="on"
									data-setting-key="night_mode">
								<label class="custom-control-label"
									for="night-mode-on"><?php echo e($__t('On')); ?></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input class="custom-control-input user-setting-control"
									type="radio"
									name="night-mode"
									id="night-mode-follow-system"
									value="follow-system"
									data-setting-key="night_mode">
								<label class="custom-control-label"
									for="night-mode-follow-system"><?php echo e($__t('Use system setting')); ?></label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input class="custom-control-input user-setting-control"
									type="radio"
									name="night-mode"
									id="night-mode-off"
									value="off"
									data-setting-key="night_mode">
								<label class="custom-control-label"
									for="night-mode-off"><?php echo e($__t('Off')); ?></label>
							</div>
						</div>
						<div class="dropdown-item">
							<div class="form-check">
								<input class="form-check-input user-setting-control"
									type="checkbox"
									id="auto-night-mode-enabled"
									data-setting-key="auto_night_mode_enabled">
								<label class="form-check-label"
									for="auto-night-mode-enabled">
									<?php echo e($__t('Auto enable in time range')); ?>

								</label>
							</div>
							<div class="form-inline">
								<input type="text"
									class="form-control my-1 user-setting-control"
									readonly
									id="auto-night-mode-time-range-from"
									placeholder="<?php echo e($__t('From')); ?> (<?php echo e($__t('in format')); ?> HH:mm)"
									data-setting-key="auto_night_mode_time_range_from">
								<input type="text"
									class="form-control user-setting-control"
									readonly
									id="auto-night-mode-time-range-to"
									placeholder="<?php echo e($__t('To')); ?> (<?php echo e($__t('in format')); ?> HH:mm)"
									data-setting-key="auto_night_mode_time_range_to">
							</div>
							<div class="form-check mt-1">
								<input class="form-check-input user-setting-control"
									type="checkbox"
									id="auto-night-mode-time-range-goes-over-midgnight"
									data-setting-key="auto_night_mode_time_range_goes_over_midnight">
								<label class="form-check-label"
									for="auto-night-mode-time-range-goes-over-midgnight">
									<?php echo e($__t('Time range goes over midnight')); ?>

								</label>
							</div>
						</div>
						<div class="dropdown-divider"></div>
						<div class="dropdown-item">
							<div class="form-check">
								<input class="form-check-input user-setting-control"
									type="checkbox"
									id="keep_screen_on"
									data-setting-key="keep_screen_on">
								<label class="form-check-label"
									for="keep_screen_on">
									<?php echo e($__t('Keep screen on')); ?>

								</label>
							</div>
						</div>
						<div class="dropdown-item">
							<div class="form-check">
								<input class="form-check-input user-setting-control"
									type="checkbox"
									id="keep_screen_on_when_fullscreen_card"
									data-setting-key="keep_screen_on_when_fullscreen_card">
								<label class="form-check-label"
									for="keep_screen_on_when_fullscreen_card">
									<?php echo e($__t('Keep screen on while displaying a "fullscreen-card"')); ?>

								</label>
							</div>
						</div>
					</div>
				</li>
				<?php endif; ?>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle discrete-link"
						href="#"
						data-toggle="dropdown"><i class="fa-solid fa-wrench"></i> <span class="d-inline d-lg-none"><?php echo e($__t('Settings')); ?></span></a>

					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item discrete-link"
							href="<?php echo e($U('/stocksettings')); ?>"><i class="fa-solid fa-fw fa-box"></i>&nbsp;<?php echo e($__t('Stock settings')); ?></a>
						<?php if(GROCY_FEATURE_FLAG_SHOPPINGLIST): ?>
						<a class="dropdown-item discrete-link permission-SHOPPINGLIST"
							href="<?php echo e($U('/shoppinglistsettings')); ?>"><i class="fa-solid fa-fw fa-shopping-cart"></i>&nbsp;<?php echo e($__t('Shopping list settings')); ?></a>
						<?php endif; ?>
						<?php if(GROCY_FEATURE_FLAG_RECIPES): ?>
						<a class="dropdown-item discrete-link permission-RECIPES"
							href="<?php echo e($U('/recipessettings')); ?>"><i class="fa-solid fa-fw fa-pizza-slice"></i>&nbsp;<?php echo e($__t('Recipes settings')); ?></a>
						<?php endif; ?>
						<?php if(GROCY_FEATURE_FLAG_CHORES): ?>
						<a class="dropdown-item discrete-link permission-CHORES"
							href="<?php echo e($U('/choressettings')); ?>"><i class="fa-solid fa-fw fa-home"></i>&nbsp;<?php echo e($__t('Chores settings')); ?></a>
						<?php endif; ?>
						<?php if(GROCY_FEATURE_FLAG_TASKS): ?>
						<a class="dropdown-item discrete-link permission-TASKS"
							href="<?php echo e($U('/taskssettings')); ?>"><i class="fa-solid fa-fw fa-tasks"></i>&nbsp;<?php echo e($__t('Tasks settings')); ?></a>
						<?php endif; ?>
						<?php if(GROCY_FEATURE_FLAG_BATTERIES): ?>
						<a class="dropdown-item discrete-link permission-BATTERIES"
							href="<?php echo e($U('/batteriessettings')); ?>"><i class="fa-solid fa-fw fa-battery-half"></i>&nbsp;<?php echo e($__t('Batteries settings')); ?></a>
						<?php endif; ?>
						<div class="dropdown-divider"></div>
						<a data-href="<?php echo e($U('/usersettings')); ?>"
							class="dropdown-item discrete-link link-return">
							<i class="fa-solid fa-fw fa-user-cog"></i> <?php echo e($__t('User settings')); ?>

						</a>
						<a class="dropdown-item discrete-link permission-USERS_READ"
							href="<?php echo e($U('/users')); ?>"><i class="fa-solid fa-fw fa-users"></i>&nbsp;<?php echo e($__t('Manage users')); ?></a>
						<div class="dropdown-divider"></div>
						<?php if(!GROCY_DISABLE_AUTH): ?>
						<a class="dropdown-item discrete-link"
							href="<?php echo e($U('/manageapikeys')); ?>"><i class="fa-solid fa-fw fa-handshake"></i>&nbsp;<?php echo e($__t('Manage API keys')); ?></a>
						<?php endif; ?>
						<a class="dropdown-item discrete-link"
							target="_blank"
							href="<?php echo e($U('/api')); ?>"><i class="fa-solid fa-fw fa-book"></i>&nbsp;<?php echo e($__t('REST API browser')); ?></a>
						<a class="dropdown-item discrete-link"
							href="<?php echo e($U('/barcodescannertesting')); ?>"><i class="fa-solid fa-fw fa-barcode"></i>&nbsp;<?php echo e($__t('Barcode scanner testing')); ?></a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item discrete-link show-as-dialog-link"
							data-dialog-type="wider"
							href="<?php echo e($U('/about?embedded')); ?>"><i class="fa-solid fa-fw fa-info"></i>&nbsp;<?php echo e($__t('About Grocy')); ?></a>
					</div>
				</li>
			</ul>
		</div><?php endif; ?>
	</nav>
	<?php endif; ?>

	<div class="<?php if(GROCY_AUTHENTICATED): ?> content-wrapper <?php endif; ?> pt-0">
		<div class="container-fluid <?php if(GROCY_AUTHENTICATED && !$embedded): ?> pr-1 pl-md-3 pl-2 <?php endif; ?> <?php if($embedded): ?> px-1 <?php endif; ?>">
			<div class="row mb-3">
				<div id="page-content"
					class="col content-text">
					<?php echo $__env->yieldContent('content'); ?>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo e($U('/packages/jquery/dist/jquery.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/bootstrap/dist/js/bootstrap.bundle.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/bootbox/dist/bootbox.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/jquery-serializejson/jquery.serializejson.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/moment/min/moment.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php if(!empty($__t('moment_locale') && $__t('moment_locale') != 'x')): ?><script src="<?php echo e($U('/packages', true)); ?>/moment/locale/<?php echo e($__t('moment_locale')); ?>.js?v=<?php echo e($version); ?>"></script><?php endif; ?>
	<script src="<?php echo e($U('/packages/toastr/build/toastr.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/sprintf-js/dist/sprintf.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/gettext-translator/dist/translator.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/nosleep.js/dist/NoSleep.min.js?v=', true)); ?><?php echo e($version); ?>"></script>

	<?php if(in_array('bootstrap-combobox', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>
	<?php if(in_array('datatables', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/datatables.net/js/jquery.dataTables.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-bs4/js/dataTables.bootstrap4.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-colreorder/js/dataTables.colReorder.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-colreorder-bs4/js/colReorder.bootstrap4.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-plugins/filtering/type-based/accent-neutralise.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-plugins/sorting/chinese-string.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-rowgroup/js/dataTables.rowGroup.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-rowgroup-bs4/js/rowGroup.bootstrap4.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-select/js/dataTables.select.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/datatables.net-select-bs4/js/select.bootstrap4.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>
	<?php if(in_array('tempusdominus', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>
	<?php if(in_array('summernote', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/summernote/dist/summernote-bs4.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php if(!empty($__t('summernote_locale') && $__t('summernote_locale') != 'x')): ?><script src="<?php echo e($U('/packages', true)); ?>/summernote/dist/lang/summernote-<?php echo e($__t('summernote_locale')); ?>.js?v=<?php echo e($version); ?>"></script><?php endif; ?>
	<?php endif; ?>
	<?php if(in_array('bootstrap-select', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/bootstrap-select/dist/js/bootstrap-select.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php if(!empty($__t('bootstrap-select_locale') && $__t('bootstrap-select_locale') != 'x')): ?><script src="<?php echo e($U('/packages', true)); ?>/bootstrap-select/dist/js/i18n/defaults-<?php echo e($__t('bootstrap-select_locale')); ?>.js?v=<?php echo e($version); ?>"></script><?php endif; ?>
	<?php endif; ?>
	<?php if(in_array('fullcalendar', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/fullcalendar/dist/fullcalendar.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php if(!empty($__t('fullcalendar_locale') && $__t('fullcalendar_locale') != 'x')): ?><script src="<?php echo e($U('/packages', true)); ?>/fullcalendar/dist/locale/<?php echo e($__t('fullcalendar_locale')); ?>.js?v=<?php echo e($version); ?>"></script><?php endif; ?>
	<?php endif; ?>
	<?php if(in_array('daterangepicker', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/daterangepicker/daterangepicker.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>
	<?php if(in_array('zxing', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/@zxing/library/umd/index.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>
	<?php if(in_array('bwipjs', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/bwip-js/dist/bwip-js-min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>
	<?php if(in_array('chartjs', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/packages/chart.js/dist/Chart.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/chartjs-plugin-colorschemes/dist/chartjs-plugin-colorschemes.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/chartjs-plugin-doughnutlabel/dist/chartjs-plugin-doughnutlabel.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/chartjs-plugin-piechart-outlabels/dist/chartjs-plugin-piechart-outlabels.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/packages/chartjs-plugin-trendline/dist/chartjs-plugin-trendline.min.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>

	<script src="<?php echo e($U('/js/extensions.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/js/grocy_menu_layout.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/js/grocy.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/js/grocy_dbchangedhandling.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/js/grocy_wakelockhandling.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/js/grocy_nightmode.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<script src="<?php echo e($U('/js/grocy_clock.js?v=', true)); ?><?php echo e($version); ?>"></script>

	<?php if(in_array('datatables', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/js/grocy_datatables.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>
	<?php if(in_array('summernote', $GROCY_REQUIRED_FRONTEND_PACKAGES)): ?>
	<script src="<?php echo e($U('/js/grocy_summernote.js?v=', true)); ?><?php echo e($version); ?>"></script>
	<?php endif; ?>

	<?php echo $__env->yieldPushContent('pageScripts'); ?>
	<?php echo $__env->yieldPushContent('componentScripts'); ?>
	<script src="<?php echo e($U('/viewjs/' . $viewName . '.js?v=', true)); ?><?php echo e($version); ?>"></script>

	<?php if(file_exists(GROCY_DATAPATH . '/custom_js.html')): ?>
	<?php include GROCY_DATAPATH . '/custom_js.html' ?>
	<?php endif; ?>
</body>

</html>
<?php /**PATH /app/www/views/layout/default.blade.php ENDPATH**/ ?>