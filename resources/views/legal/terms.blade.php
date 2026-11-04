{{--
    Place at: resources/views/legal/terms.blade.php
    Route (add to routes/web.php):
        Route::view('/terms', 'legal.terms')->name('terms');
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Terms and Conditions') }} — Ascend</title>
    <link rel="icon" href="{{ asset('assets/logo/ascend-w.png') }}" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/css/auth.css'])
</head>
<body class="font-body antialiased legal-page">

    <header class="legal-header">
        <div class="container" style="max-width: 44rem; margin-inline: auto; padding-inline: 1.25rem;">
            <a href="{{ url('/') }}" class="inline-flex">
                <img src="{{ asset('assets/logo/ascend-wt2.png') }}" alt="Ascend" class="h-7 w-auto">
            </a>
        </div>
    </header>

    <main class="legal-main">
        <article class="legal-article">
            <h1>{{ __('Ascend Terms and Conditions') }}</h1>
            <p class="legal-updated">{{ __('Last Updated: November 3, 2026') }}</p>

            <h2>{{ __('1. Acceptance of Terms') }}</h2>
            <p>{{ __('By accessing or using Ascend, you agree to comply with these Terms and Conditions. If you do not agree with these terms, you must discontinue using the application.') }}</p>

            <h2>{{ __('2. About Ascend') }}</h2>
            <p>{{ __('Ascend is a gym management system designed to support gym operations, membership management, and the organization of gym-related information.') }}</p>

            <h2>{{ __('3. User Accounts') }}</h2>
            <p>{{ __('Users are responsible for maintaining the confidentiality of their account credentials and for all activities performed under their accounts.') }}</p>
            <p>{{ __('Users agree to:') }}</p>
            <ul>
                <li>{{ __('Provide accurate and complete information.') }}</li>
                <li>{{ __('Keep their login credentials secure.') }}</li>
                <li>{{ __('Notify the gym administration of any unauthorized account access.') }}</li>
                <li>{{ __('Avoid sharing their accounts with unauthorized individuals.') }}</li>
            </ul>

            <h2>{{ __('4. Acceptable Use') }}</h2>
            <p>{{ __('Users agree to use Ascend only for its intended purposes.') }}</p>
            <p>{{ __('Users must not:') }}</p>
            <ul>
                <li>{{ __('Access accounts or information without authorization.') }}</li>
                <li>{{ __("Attempt to interfere with the application's functionality.") }}</li>
                <li>{{ __('Submit false, misleading, or fraudulent information.') }}</li>
                <li>{{ __('Exploit system vulnerabilities or misuse application features.') }}</li>
                <li>{{ __('Use the application for unlawful activities.') }}</li>
            </ul>

            <h2>{{ __('5. Membership Information') }}</h2>
            <p>{{ __('Membership information and related records are managed through Ascend.') }}</p>
            <p>{{ __("Users are responsible for ensuring that the information they provide is accurate. Membership fees, duration, access privileges, and other gym policies are subject to the gym's applicable rules and regulations.") }}</p>
            <p>{{ __('Ascend does not independently guarantee membership availability or gym access.') }}</p>

            <h2>{{ __('6. Privacy and Data Protection') }}</h2>
            <p>{{ __('Ascend may collect and process information necessary for gym management and application functionality.') }}</p>
            <p>{{ __("Personal information will be handled in accordance with applicable privacy laws and the application's Privacy Policy.") }}</p>
            <p>{{ __('Users should avoid sharing sensitive personal information through unauthorized channels.') }}</p>

            <h2>{{ __('7. Application Availability') }}</h2>
            <p>{{ __('Ascend is provided to support gym management operations. The application may experience interruptions due to maintenance, updates, technical issues, or other circumstances.') }}</p>
            <p>{{ __('The developers do not guarantee uninterrupted availability or error-free operation.') }}</p>

            <h2>{{ __('8. Intellectual Property') }}</h2>
            <p>{{ __('The Ascend name, logo, design, and application materials are protected by applicable intellectual property laws.') }}</p>
            <p>{{ __('Users may not reproduce, distribute, modify, or use these materials without appropriate authorization.') }}</p>

            <h2>{{ __('9. Limitation of Liability') }}</h2>
            <p>{{ __('Ascend is provided on an "as is" and "as available" basis.') }}</p>
            <p>{{ __('To the extent permitted by applicable law, the developers are not responsible for losses or damages resulting from application interruptions, unauthorized account access, inaccurate information provided by users, or the inability to access the application.') }}</p>

            <h2>{{ __('10. Changes to These Terms') }}</h2>
            <p>{{ __('These Terms and Conditions may be updated as Ascend develops or as operational requirements change.') }}</p>
            <p>{{ __('Continued use of the application after changes are published constitutes acceptance of the revised terms.') }}</p>

            <h2>{{ __('11. Termination of Access') }}</h2>
            <p>{{ __('The gym administration may suspend or terminate access to Ascend when necessary, including cases involving violations of these terms, unauthorized access, or misuse of the application.') }}</p>

            <h2>{{ __('12. Governing Law') }}</h2>
            <p>{{ __('These Terms and Conditions shall be governed by the applicable laws of the Republic of the Philippines.') }}</p>

            <h2>{{ __('13. Contact Information') }}</h2>
            <p>{{ __('For questions or concerns regarding these Terms and Conditions, users may contact the gym administration or the Ascend development team.') }}</p>
            <p>{{ __("These Terms and Conditions are subject to revision as Ascend's features and operational policies evolve.") }}</p>
        </article>
    </main>

    <footer class="legal-footer">
        &copy; {{ date('Y') }} Ascend. {{ __('All rights reserved.') }}
    </footer>

</body>
</html>