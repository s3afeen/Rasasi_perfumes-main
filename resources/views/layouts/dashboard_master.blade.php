<!-- include first start -->
@include("include/dashboard/first")
<!-- include first end -->


<!-- include nav bar start -->
@include("include/dashboard/navbar")
<!-- include nav bar end -->

<main id="main" class="main">

<!-- include side bar start -->
@include("include/dashboard/sidebar")
<!-- include side bar end -->


@yield("content")


</main><!-- End #main -->

<!-- include footer start -->
 @include("include/dashboard/footer")
<!-- include footer end -->
