<div class="post">
    <?php the_post(); ?>

    <header>
        <h1>{{ $title ?? get_the_title() }}</h1>
    </header>

    <?php the_content(); ?>

    <?php edit_post_link(); ?>
</div><!-- /post -->
