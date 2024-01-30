<?php


return [
    'failed'   => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'confirm_password' => [
        'heading' => 'This is a secure area of the application. Please confirm your password before continuing.',
        'password' => 'Password',
        'submit' => 'Confirm',
    ],
    'forget' => [
        'heading' =>"Forgot your password? No problem. Just let us know your email
            address and we will email you a password reset link that will allow
            you to choose a new one.",

        'link' => "Email Password Reset Link",
        'login_link_text' => "Log in",
        'registration_link' => "Create New Account?",
        'form' => [
            'email' => "Email",
        ]
    ],

    'login' => [
        'registration_link' => "Create New Account?",
        'remember_me' => "Remember me",
        'forget_link' => "Forgot your password?",
        'submit' => "Log in",
        'form' => [
            'email' => "Email",
            'password' => "Password",
        ]
    ],

    'register' => [
        'login_link' =>  " Already registered?",
        'remember_me' => "Remember me",
        'submit' => "Submit",
        'form' => [
            'name' => "Name",
            'email' => "Email",
            'password' => "Password",
            'confirm_password' =>  'Confirm Password',
        ]
    ],

    'reset' => [
        'submit' =>  "Reset Password",
        'form' => [
            'email' => "Email",
            'password' => "Password",
            'confirm_password' =>  'Confirm Password',
        ]
    ],
   'verify_email' => [
        'heading' => "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
         we just emailed to you? If you didn't receive the email, we will gladly send you another.",
        'message' => 'A new verification link has been sent to the email address you
            provided during registration.',
        'resend_link' => 'Resend Verification Email',
        'log_out' => 'Log out',
    ],

];
