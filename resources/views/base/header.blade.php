<!DOCTYPE html>
<html {!! get_language_attributes() !!}>
<head>
  <meta charset="{{ info('charset') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Disable tap highlight on IE -->
  <meta name="msapplication-tap-highlight" content="no">

  <link rel="stylesheet" href="{{ info('stylesheet_url') }}">

  @php wp_head() @endphp
</head>
<body @php body_class() @endphp>

         @include('partials/cookie-bar')
