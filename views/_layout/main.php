<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($title ?? '') . ' ' . $_ENV['SITE_NAME'] ?></title>
    <link rel="stylesheet" href="/css/output.css?v=<?php if ($_ENV['DEV_MODE'] == "true") {
                                                        echo time();
                                                    }; ?>">
</head>

<body class="bg-gray-200 flex">
    <nav class="top-0 left-0 w-max flex flex-col items-center h-screen bg-tertiary text-[#f8f8ff] py-3 px-5">
        <div class="brand">
            <svg width="50px" height="50px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 203 344.51">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #231f20;
                        }

                        .cls-2 {
                            fill: #fff;
                        }
                    </style>
                </defs>
                <path class="cls-1" d="M36,0h132.54s16.46,2,24.46,13,10,19,10,32v261c0,2.45-.17,5.93-1,10-1.08,5.31-2.48,12.16-8,18-4.27,4.52-9.12,6.43-12,7.53-5.5,2.1-10.14,2.38-12,2.47-22.4,1.13-128.31.06-129,0-2.06.22-18.83,1.75-31-11C.94,323.51.12,312.08,0,309V39.2c.18-3.3,1.3-16.37,12-27.2C21.37,2.52,32.4.51,36,0Z" />
                <path class="cls-2" d="M11,308c-.33-90.33-.67-180.67-1-271,0,0,2-11,7-16s18-9,18-9h22.4s2.6,18,9.6,18,56,1,56,1c14,0,17.74-1.4,19-4,1.02-2.11.79-6.08,3-13,.25-.78.46-1.39,1-2,1.89-2.16,5.37-1.67,12-1,2.19.22,5.84.57,10.54.94,0,0,24.46,2.06,24.46,37.06v255c.01,3.35-.31,15.13-8,23-2.22,2.27-4.6,3.75-5,4-6.01,3.7-12.02,4.04-15,4H37c-3.79-.78-8-2-14-6-3.14-2.09-7.4-5.2-10-11-1.81-4.04-2.04-7.77-2-10Z" />
                <path class="cls-1" d="M48,22c.62,4.13,2.35,11.03,8,15,3.54,2.49,7.25,2.85,9,3,10.16.85,37.48,1.33,74,1,4.35.22,6.76-1.08,8-2,2.98-2.22,4.59-7.17,7.69-17,.13-.43.24-.78.31-1h13c3.16.37,7.75,1.44,11,5,3.77,4.13,3.96,9.66,4,12,.21,11.21.29,118.66,0,266,0,0-4,18-16,20s-123,0-123,0c0,0-23,0-24-16s0-268,0-268c.02-1.96.34-6.05,3-10,3.93-5.84,10.26-7.33,13.14-8,4.77-1.12,8.97-.65,11.86,0Z" />
                <polygon class="cls-2" points="203 45 0 251.82 0 268.25 203 60.46 203 45" />
                <path class="cls-2" d="M83,129s-27-20-8,5,19.34,21.7,19.34,21.7l8.61-8.77-19.95-17.93Z" />
                <path class="cls-2" d="M121.19,178.6s30.21,27.29,4.51-5.15-14.87-18.64-14.87-18.64l-7.88,8.06,18.23,15.73Z" />
            </svg>
        </div>
        <div class="flex-grow flex flex-col items-start justify-center gap-3 mt-auto">
            <a class="flex items-center" href="/">
                <svg width="50px" height="50px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.918 10.0005H7.082C6.66587 9.99708 6.26541 10.1591 5.96873 10.4509C5.67204 10.7427 5.50343 11.1404 5.5 11.5565V17.4455C5.5077 18.3117 6.21584 19.0078 7.082 19.0005H9.918C10.3341 19.004 10.7346 18.842 11.0313 18.5502C11.328 18.2584 11.4966 17.8607 11.5 17.4445V11.5565C11.4966 11.1404 11.328 10.7427 11.0313 10.4509C10.7346 10.1591 10.3341 9.99708 9.918 10.0005Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.918 4.0006H7.082C6.23326 3.97706 5.52559 4.64492 5.5 5.4936V6.5076C5.52559 7.35629 6.23326 8.02415 7.082 8.0006H9.918C10.7667 8.02415 11.4744 7.35629 11.5 6.5076V5.4936C11.4744 4.64492 10.7667 3.97706 9.918 4.0006Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.082 13.0007H17.917C18.3333 13.0044 18.734 12.8425 19.0309 12.5507C19.3278 12.2588 19.4966 11.861 19.5 11.4447V5.55666C19.4966 5.14054 19.328 4.74282 19.0313 4.45101C18.7346 4.1592 18.3341 3.9972 17.918 4.00066H15.082C14.6659 3.9972 14.2654 4.1592 13.9687 4.45101C13.672 4.74282 13.5034 5.14054 13.5 5.55666V11.4447C13.5034 11.8608 13.672 12.2585 13.9687 12.5503C14.2654 12.8421 14.6659 13.0041 15.082 13.0007Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.082 19.0006H17.917C18.7661 19.0247 19.4744 18.3567 19.5 17.5076V16.4936C19.4744 15.6449 18.7667 14.9771 17.918 15.0006H15.082C14.2333 14.9771 13.5256 15.6449 13.5 16.4936V17.5066C13.525 18.3557 14.2329 19.0241 15.082 19.0006Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Dashboard
            </a>
            <a class="flex items-center" href="/addRepair">
                <svg width="50px" height="50px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.875 11.2502C9.46079 11.2502 9.125 11.586 9.125 12.0002C9.125 12.4145 9.46079 12.7502 9.875 12.7502V11.2502ZM12.5 12.7502C12.9142 12.7502 13.25 12.4145 13.25 12.0002C13.25 11.586 12.9142 11.2502 12.5 11.2502V12.7502ZM12.5 11.2502C12.0858 11.2502 11.75 11.586 11.75 12.0002C11.75 12.4145 12.0858 12.7502 12.5 12.7502V11.2502ZM15.125 12.7502C15.5392 12.7502 15.875 12.4145 15.875 12.0002C15.875 11.586 15.5392 11.2502 15.125 11.2502V12.7502ZM13.25 12.0002C13.25 11.586 12.9142 11.2502 12.5 11.2502C12.0858 11.2502 11.75 11.586 11.75 12.0002H13.25ZM11.75 14.6252C11.75 15.0395 12.0858 15.3752 12.5 15.3752C12.9142 15.3752 13.25 15.0395 13.25 14.6252H11.75ZM11.75 12.0002C11.75 12.4145 12.0858 12.7502 12.5 12.7502C12.9142 12.7502 13.25 12.4145 13.25 12.0002H11.75ZM13.25 9.37524C13.25 8.96103 12.9142 8.62524 12.5 8.62524C12.0858 8.62524 11.75 8.96103 11.75 9.37524H13.25ZM9.875 12.7502H12.5V11.2502H9.875V12.7502ZM12.5 12.7502H15.125V11.2502H12.5V12.7502ZM11.75 12.0002V14.6252H13.25V12.0002H11.75ZM13.25 12.0002V9.37524H11.75V12.0002H13.25Z" fill="#fff" />
                </svg>
                Add new repair
            </a>
            <a class="flex items-center" href="/addPart">
                <svg width="50px" height="50px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 12.0002C5.50024 8.66068 7.85944 5.78639 11.1348 5.1351C14.4102 4.48382 17.6895 6.23693 18.9673 9.32231C20.2451 12.4077 19.1655 15.966 16.3887 17.8212C13.6119 19.6764 9.91127 19.3117 7.55 16.9502C6.23728 15.6373 5.49987 13.8568 5.5 12.0002Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.875 11.2502C9.46079 11.2502 9.125 11.586 9.125 12.0002C9.125 12.4145 9.46079 12.7502 9.875 12.7502V11.2502ZM12.5 12.7502C12.9142 12.7502 13.25 12.4145 13.25 12.0002C13.25 11.586 12.9142 11.2502 12.5 11.2502V12.7502ZM12.5 11.2502C12.0858 11.2502 11.75 11.586 11.75 12.0002C11.75 12.4145 12.0858 12.7502 12.5 12.7502V11.2502ZM15.125 12.7502C15.5392 12.7502 15.875 12.4145 15.875 12.0002C15.875 11.586 15.5392 11.2502 15.125 11.2502V12.7502ZM13.25 12.0002C13.25 11.586 12.9142 11.2502 12.5 11.2502C12.0858 11.2502 11.75 11.586 11.75 12.0002H13.25ZM11.75 14.6252C11.75 15.0395 12.0858 15.3752 12.5 15.3752C12.9142 15.3752 13.25 15.0395 13.25 14.6252H11.75ZM11.75 12.0002C11.75 12.4145 12.0858 12.7502 12.5 12.7502C12.9142 12.7502 13.25 12.4145 13.25 12.0002H11.75ZM13.25 9.37524C13.25 8.96103 12.9142 8.62524 12.5 8.62524C12.0858 8.62524 11.75 8.96103 11.75 9.37524H13.25ZM9.875 12.7502H12.5V11.2502H9.875V12.7502ZM12.5 12.7502H15.125V11.2502H12.5V12.7502ZM11.75 12.0002V14.6252H13.25V12.0002H11.75ZM13.25 12.0002V9.37524H11.75V12.0002H13.25Z" fill="#fff" />
                </svg>
                Add new part
            </a>
            <a class="flex items-center" href="/repairs">
                <svg width="50px" height="50px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.5 9.75C16.9142 9.75 17.25 9.41421 17.25 9C17.25 8.58579 16.9142 8.25 16.5 8.25V9.75ZM10.5 8.25C10.0858 8.25 9.75 8.58579 9.75 9C9.75 9.41421 10.0858 9.75 10.5 9.75V8.25ZM16.5 12.75C16.9142 12.75 17.25 12.4142 17.25 12C17.25 11.5858 16.9142 11.25 16.5 11.25V12.75ZM10.5 11.25C10.0858 11.25 9.75 11.5858 9.75 12C9.75 12.4142 10.0858 12.75 10.5 12.75V11.25ZM13.5 15.75C13.9142 15.75 14.25 15.4142 14.25 15C14.25 14.5858 13.9142 14.25 13.5 14.25V15.75ZM10.5 14.25C10.0858 14.25 9.75 14.5858 9.75 15C9.75 15.4142 10.0858 15.75 10.5 15.75V14.25ZM7.5 14.75C7.91421 14.75 8.25 14.4142 8.25 14C8.25 13.5858 7.91421 13.25 7.5 13.25V14.75ZM6.5 13.25C6.08579 13.25 5.75 13.5858 5.75 14C5.75 14.4142 6.08579 14.75 6.5 14.75V13.25ZM4.5 13.25C4.08579 13.25 3.75 13.5858 3.75 14C3.75 14.4142 4.08579 14.75 4.5 14.75V13.25ZM6.5 14.75C6.91421 14.75 7.25 14.4142 7.25 14C7.25 13.5858 6.91421 13.25 6.5 13.25V14.75ZM7.5 10.75C7.91421 10.75 8.25 10.4142 8.25 10C8.25 9.58579 7.91421 9.25 7.5 9.25V10.75ZM6.5 9.25C6.08579 9.25 5.75 9.58579 5.75 10C5.75 10.4142 6.08579 10.75 6.5 10.75V9.25ZM4.5 9.25C4.08579 9.25 3.75 9.58579 3.75 10C3.75 10.4142 4.08579 10.75 4.5 10.75V9.25ZM6.5 10.75C6.91421 10.75 7.25 10.4142 7.25 10C7.25 9.58579 6.91421 9.25 6.5 9.25V10.75ZM5.75 10C5.75 10.4142 6.08579 10.75 6.5 10.75C6.91421 10.75 7.25 10.4142 7.25 10H5.75ZM6.5 15H5.75H6.5ZM7.25 14C7.25 13.5858 6.91421 13.25 6.5 13.25C6.08579 13.25 5.75 13.5858 5.75 14H7.25ZM7.25 10C7.25 9.58579 6.91421 9.25 6.5 9.25C6.08579 9.25 5.75 9.58579 5.75 10H7.25ZM5.75 14C5.75 14.4142 6.08579 14.75 6.5 14.75C6.91421 14.75 7.25 14.4142 7.25 14H5.75ZM16.5 8.25H10.5V9.75H16.5V8.25ZM16.5 11.25H10.5V12.75H16.5V11.25ZM13.5 14.25H10.5V15.75H13.5V14.25ZM7.5 13.25H6.5V14.75H7.5V13.25ZM4.5 14.75H6.5V13.25H4.5V14.75ZM7.5 9.25H6.5V10.75H7.5V9.25ZM4.5 10.75H6.5V9.25H4.5V10.75ZM7.25 10V9H5.75V10H7.25ZM7.25 9C7.25 7.20507 8.70507 5.75 10.5 5.75V4.25C7.87665 4.25 5.75 6.37665 5.75 9H7.25ZM10.5 5.75H16.5V4.25H10.5V5.75ZM16.5 5.75C18.2949 5.75 19.75 7.20507 19.75 9H21.25C21.25 6.37665 19.1234 4.25 16.5 4.25V5.75ZM19.75 9V15H21.25V9H19.75ZM19.75 15C19.75 16.7949 18.2949 18.25 16.5 18.25V19.75C19.1234 19.75 21.25 17.6234 21.25 15H19.75ZM16.5 18.25H10.5V19.75H16.5V18.25ZM10.5 18.25C8.70507 18.25 7.25 16.7949 7.25 15H5.75C5.75 17.6234 7.87665 19.75 10.5 19.75V18.25ZM7.25 15V14H5.75V15H7.25ZM5.75 10V14H7.25V10H5.75Z" fill="#FFF" />
                </svg>
                Montly repairs
            </a>
            <a class="flex items-center" href="/parts">
                <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 14C20 17.7712 20 19.6569 18.8284 20.8284C17.6569 22 15.7712 22 12 22C8.22876 22 6.34315 22 5.17157 20.8284C4 19.6569 4 17.7712 4 14V10C4 6.22876 4 4.34315 5.17157 3.17157C6.34315 2 8.22876 2 12 2C15.7712 2 17.6569 2 18.8284 3.17157C20 4.34315 20 6.22876 20 10" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M15 19H9" stroke="#FFF" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                Parts
            </a>
            <a class="flex items-center" href="/filemanager">
                <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.65 6.471C4.65 6.05679 4.31421 5.721 3.9 5.721C3.48578 5.721 3.15 6.05679 3.15 6.471H4.65ZM3.9 17.353L4.65 17.3539V17.353H3.9ZM4.36838 18.5168L4.90602 17.9939L4.90602 17.9939L4.36838 18.5168ZM5.50192 19L5.50099 19.75H5.50192V19ZM17.8981 19L17.8981 19.75L17.899 19.75L17.8981 19ZM19.0316 18.5168L18.494 17.9939L18.494 17.9939L19.0316 18.5168ZM19.5 17.353L18.75 17.353L18.75 17.3539L19.5 17.353ZM19.5 8.118L18.75 8.11711V8.118H19.5ZM19.0316 6.95422L18.494 7.47715L18.494 7.47715L19.0316 6.95422ZM17.8981 6.471L17.899 5.721H17.8981V6.471ZM12.2226 5.721C11.8084 5.721 11.4726 6.05679 11.4726 6.471C11.4726 6.88521 11.8084 7.221 12.2226 7.221V5.721ZM3.15 6.471C3.15 6.88521 3.48578 7.221 3.9 7.221C4.31421 7.221 4.65 6.88521 4.65 6.471H3.15ZM3.9 5.647L4.65 5.647L4.64999 5.64611L3.9 5.647ZM4.36838 4.48322L4.90602 5.00615L4.90602 5.00615L4.36838 4.48322ZM5.50192 4L5.50192 3.25L5.50099 3.25L5.50192 4ZM10.6207 4L10.6216 3.25H10.6207V4ZM11.7542 4.48322L11.2166 5.00615L11.2166 5.00615L11.7542 4.48322ZM12.2226 5.647L11.4726 5.64611V5.647H12.2226ZM11.4726 6.471C11.4726 6.88521 11.8084 7.221 12.2226 7.221C12.6368 7.221 12.9726 6.88521 12.9726 6.471H11.4726ZM3.9 5.721C3.48578 5.721 3.15 6.05679 3.15 6.471C3.15 6.88521 3.48578 7.221 3.9 7.221V5.721ZM12.2226 7.221C12.6368 7.221 12.9726 6.88521 12.9726 6.471C12.9726 6.05679 12.6368 5.721 12.2226 5.721V7.221ZM3.15 6.471V17.353H4.65V6.471H3.15ZM3.15 17.3521C3.14925 17.9813 3.39203 18.5886 3.83074 19.0397L4.90602 17.9939C4.74389 17.8272 4.64971 17.5973 4.64999 17.3539L3.15 17.3521ZM3.83074 19.0397C4.27008 19.4914 4.87048 19.7492 5.50099 19.75L5.50285 18.25C5.28261 18.2497 5.06752 18.1599 4.90602 17.9939L3.83074 19.0397ZM5.50192 19.75H17.8981V18.25H5.50192V19.75ZM17.899 19.75C18.5295 19.7492 19.1299 19.4914 19.5692 19.0397L18.494 17.9939C18.3325 18.1599 18.1174 18.2497 17.8971 18.25L17.899 19.75ZM19.5692 19.0397C20.008 18.5886 20.2507 17.9813 20.25 17.3521L18.75 17.3539C18.7503 17.5973 18.6561 17.8272 18.494 17.9939L19.5692 19.0397ZM20.25 17.353V8.118H18.75V17.353H20.25ZM20.25 8.11889C20.2507 7.48974 20.008 6.88236 19.5692 6.4313L18.494 7.47715C18.6561 7.64383 18.7503 7.8737 18.75 8.11711L20.25 8.11889ZM19.5692 6.4313C19.1299 5.9796 18.5295 5.72179 17.899 5.721L17.8971 7.221C18.1174 7.22127 18.3325 7.3111 18.494 7.47715L19.5692 6.4313ZM17.8981 5.721H12.2226V7.221H17.8981V5.721ZM4.65 6.471V5.647H3.15V6.471H4.65ZM4.64999 5.64611C4.64971 5.4027 4.74389 5.17283 4.90602 5.00615L3.83074 3.9603C3.39203 4.41136 3.14925 5.01874 3.15 5.64789L4.64999 5.64611ZM4.90602 5.00615C5.06751 4.8401 5.28261 4.75027 5.50285 4.75L5.50099 3.25C4.87048 3.25079 4.27008 3.5086 3.83074 3.9603L4.90602 5.00615ZM5.50192 4.75H10.6207V3.25H5.50192V4.75ZM10.6197 4.75C10.84 4.75027 11.0551 4.8401 11.2166 5.00615L12.2918 3.9603C11.8525 3.5086 11.2521 3.25079 10.6216 3.25L10.6197 4.75ZM11.2166 5.00615C11.3787 5.17283 11.4729 5.4027 11.4726 5.64611L12.9726 5.64789C12.9733 5.01874 12.7306 4.41136 12.2918 3.9603L11.2166 5.00615ZM11.4726 5.647V6.471H12.9726V5.647H11.4726ZM3.9 7.221H12.2226V5.721H3.9V7.221Z" fill="#FFF" />
                </svg>
                Filemanager
            </a>
        </div>
    </nav>


    <main class="w-9/12 m-auto">
        <?= $content; ?>
    </main>

</body>

</html>