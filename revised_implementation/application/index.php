<!DOCTYPE html>
<html lang="en">
<?php
function fetchHostName()
{
  $hostname = file_get_contents('http://169.254.169.254/latest/meta-data/public-hostname');
  return (empty($hostname)) ? "No Public DNS - (EC2 in a private subnet)" : $hostname;
}
?>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Web application</title>
  <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
    html {
      line-height: 1.15;
      -webkit-text-size-adjust: 100%;
    }

    body {
      margin: 0;
    }

    a {
      background-color: transparent;
    }

    [hidden] {
      display: none;
    }

    html {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI,
        Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif,
        Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
      line-height: 1.5;
    }

    *,
    :after,
    :before {
      box-sizing: border-box;
      border: 0 solid #e2e8f0;
    }

    a {
      color: inherit;
      text-decoration: inherit;
    }

    svg,
    video {
      display: block;
    }

    video {
      max-width: 100%;
      height: auto;
    }

    .bg-white {
      --tw-bg-opacity: 1;
      background-color: rgb(255 255 255 / var(--tw-bg-opacity));
    }

    .bg-gray-100 {
      --tw-bg-opacity: 1;
      background-color: rgb(243 244 246 / var(--tw-bg-opacity));
    }

    .border-gray-200 {
      --tw-border-opacity: 1;
      border-color: rgb(229 231 235 / var(--tw-border-opacity));
    }

    .border-t {
      border-top-width: 1px;
    }

    .flex {
      display: flex;
    }

    .grid {
      display: grid;
    }

    .hidden {
      display: none;
    }

    .items-center {
      align-items: center;
    }

    .justify-center {
      justify-content: center;
    }

    .font-semibold {
      font-weight: 600;
    }

    .h-5 {
      height: 1.25rem;
    }

    .h-8 {
      height: 2rem;
    }

    .h-16 {
      height: 4rem;
    }

    .text-sm {
      font-size: 0.875rem;
    }

    .text-lg {
      font-size: 1.125rem;
    }

    .leading-7 {
      line-height: 1.75rem;
    }

    .mx-auto {
      margin-left: auto;
      margin-right: auto;
    }

    .ml-1 {
      margin-left: 0.25rem;
    }

    .mt-2 {
      margin-top: 0.5rem;
    }

    .mr-2 {
      margin-right: 0.5rem;
    }

    .ml-2 {
      margin-left: 0.5rem;
    }

    .mt-4 {
      margin-top: 1rem;
    }

    .ml-4 {
      margin-left: 1rem;
    }

    .mt-8 {
      margin-top: 2rem;
    }

    .ml-12 {
      margin-left: 3rem;
    }

    .-mt-px {
      margin-top: -1px;
    }

    .max-w-6xl {
      max-width: 72rem;
    }

    .min-h-screen {
      min-height: 100vh;
    }

    .overflow-hidden {
      overflow: hidden;
    }

    .p-6 {
      padding: 1.5rem;
    }

    .py-4 {
      padding-top: 1rem;
      padding-bottom: 1rem;
    }

    .px-6 {
      padding-left: 1.5rem;
      padding-right: 1.5rem;
    }

    .pt-8 {
      padding-top: 2rem;
    }

    .fixed {
      position: fixed;
    }

    .relative {
      position: relative;
    }

    .top-0 {
      top: 0;
    }

    .right-0 {
      right: 0;
    }

    .shadow {
      --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1),
        0 1px 2px -1px rgb(0 0 0 / 0.1);
      --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color),
        0 1px 2px -1px var(--tw-shadow-color);
      box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
        var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    .text-center {
      text-align: center;
    }

    .text-gray-200 {
      --tw-text-opacity: 1;
      color: rgb(229 231 235 / var(--tw-text-opacity));
    }

    .text-gray-300 {
      --tw-text-opacity: 1;
      color: rgb(209 213 219 / var(--tw-text-opacity));
    }

    .text-gray-400 {
      --tw-text-opacity: 1;
      color: rgb(156 163 175 / var(--tw-text-opacity));
    }

    .text-gray-500 {
      --tw-text-opacity: 1;
      color: rgb(107 114 128 / var(--tw-text-opacity));
    }

    .text-gray-600 {
      --tw-text-opacity: 1;
      color: rgb(75 85 99 / var(--tw-text-opacity));
    }

    .text-gray-700 {
      --tw-text-opacity: 1;
      color: rgb(55 65 81 / var(--tw-text-opacity));
    }

    .text-gray-900 {
      --tw-text-opacity: 1;
      color: rgb(17 24 39 / var(--tw-text-opacity));
    }

    .underline {
      text-decoration: underline;
    }

    .antialiased {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .w-5 {
      width: 1.25rem;
    }

    .w-8 {
      width: 2rem;
    }

    .w-auto {
      width: auto;
    }

    .grid-cols-1 {
      grid-template-columns: repeat(1, minmax(0, 1fr));
    }

    @media (min-width: 640px) {
      .sm\:rounded-lg {
        border-radius: 0.5rem;
      }

      .sm\:block {
        display: block;
      }

      .sm\:items-center {
        align-items: center;
      }

      .sm\:justify-start {
        justify-content: flex-start;
      }

      .sm\:justify-between {
        justify-content: space-between;
      }

      .sm\:h-20 {
        height: 5rem;
      }

      .sm\:ml-0 {
        margin-left: 0;
      }

      .sm\:px-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
      }

      .sm\:pt-0 {
        padding-top: 0;
      }

      .sm\:text-left {
        text-align: left;
      }

      .sm\:text-right {
        text-align: right;
      }
    }

    @media (min-width: 768px) {
      .md\:border-t-0 {
        border-top-width: 0;
      }

      .md\:border-l {
        border-left-width: 1px;
      }

      .md\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (min-width: 1024px) {
      .lg\:px-8 {
        padding-left: 2rem;
        padding-right: 2rem;
      }
    }

    @media (prefers-color-scheme: dark) {
      .dark\:bg-gray-800 {
        --tw-bg-opacity: 1;
        background-color: rgb(31 41 55 / var(--tw-bg-opacity));
      }

      .dark\:bg-gray-900 {
        --tw-bg-opacity: 1;
        background-color: rgb(17 24 39 / var(--tw-bg-opacity));
      }

      .dark\:border-gray-700 {
        --tw-border-opacity: 1;
        border-color: rgb(55 65 81 / var(--tw-border-opacity));
      }

      .dark\:text-white {
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
      }

      .dark\:text-gray-400 {
        --tw-text-opacity: 1;
        color: rgb(156 163 175 / var(--tw-text-opacity));
      }

      .dark\:text-gray-500 {
        --tw-text-opacity: 1;
        color: rgb(107 114 128 / var(--tw-text-opacity));
      }
    }
  </style>
  <style>
    body {
      font-family: Nunito, sans-serif;
    }
  </style>
</head>

<body class="antialiased">
  <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div class="flex justify-center pt-8">
        <h1 class="text-gray-900 dark:text-white">Welcome</h1>
      </div>
      <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-1">
          <div class="p-6">
            <div class="flex items-center">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 dark:text-white text-gray-900">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <span class="text-gray-900 dark:text-white">Application is up and running</span>
              </div>
            </div>
          </div>

          <div class="p-6">
            <div class="flex items-center">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 dark:text-white text-gray-900">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 17.25v-.228a4.5 4.5 0 00-.12-1.03l-2.268-9.64a3.375 3.375 0 00-3.285-2.602H7.923a3.375 3.375 0 00-3.285 2.602l-2.268 9.64a4.5 4.5 0 00-.12 1.03v.228m19.5 0a3 3 0 01-3 3H5.25a3 3 0 01-3-3m19.5 0a3 3 0 00-3-3H5.25a3 3 0 00-3 3m16.5 0h.008v.008h-.008v-.008zm-3 0h.008v.008h-.008v-.008z" />
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <span class="text-gray-900 dark:text-white"><?php echo $fetchHostName() ?></span>
              </div>
            </div>
          </div>

          <div class="p-6">
            <div class="flex items-center">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 dark:text-white text-gray-900">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
              </svg>
              <div class="ml-4 text-lg leading-7 font-semibold">
                <span class="text-gray-900 dark:text-white"><?php echo file_get_contents('http://169.254.169.254/latest/meta-data/instance-id'); ?></span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</body>

</html>