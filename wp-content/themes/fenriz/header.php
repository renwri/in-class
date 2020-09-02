<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>">

	<?php wp_head(); //just a place where code can be plugged-in aka a "hook" / req for admin bar and plugins to work ?>
</head>
<body>
	<div class="site">
		<header class="header">
			<div class="header-bar">
				<h1 class="site-title">
					<a href="<?php echo home_url(); ?>">
					<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<h2><?php bloginfo( 'description' ); ?></h2>
				<nav>
					<ul class="menu">
						<?php
						wp_list_pages( array(
							'title_li' => '', //passing an empty value in this argument will take away the default Pages li; see Codex
						) );
						?>
					</ul>
				</nav>

			<?php get_search_form(); ?>

			</div>
		</header>