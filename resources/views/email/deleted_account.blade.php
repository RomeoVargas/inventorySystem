<html>
<body style="max-width:650px; width:100%; margin:0 auto; font-family:Lato, Helvetica;
    -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
<div style="
    background: red; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(red, orange); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(red, orange); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(red, orange); /* For Firefox 3.6 to 15 */
    background: linear-gradient(red, orange); /* Standard syntax */
    width:100%; text-align:center; box-sizing: border-box;
    padding:2em 1em 1em; border-radius:20px 20px 0 0; margin-top:1em;">
    <h1 style="color:white; margin-top:0;">Checon Industries: {{ $user->isCustomer() ? 'Denied Registration' : 'CMS Account Termination' }}</h1>
</div>
<div style="width:100%; border:1px solid orange; padding:2em 3em; box-sizing: border-box; color:#5e5e5e;
        text-align:justify;">
    @if($user->isCustomer())
        <p>This email is sent to inform you that your registration for a checon customer account has been rejected</p>
        <p>Your account may have been considered as spam or a hack that the administrator decided to not accept your registration</p>
    @else
        <p>This email is sent to inform you that you have no longer access to
            Checon Industries Content Management System(CMS)</p>
        <p>Your account has been permanently terminated. If you have any concerns about this, kindly contact your immediate supervisor</p>
    @endif
</div>
</body>
</html>