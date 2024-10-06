<?php
require_once './classes/user.class.php';
require_once './sanitize.php';
require_once './authmiddleware.php';

redirectIfAuth();

$userObj = new User();
$message = '';
$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitizeInput($_POST['password']) : '';

    if (verifyEmail($email) === false) {
        $emailErr = "* Invalid email format";
    }
    if (empty($email)) {
        $emailErr = "* Email is required";
    }
    if (empty($password)) {
        $passwordErr = "* Password is required";
    }

    if (empty($emailErr) && empty($passwordErr)) {
        $userObj->email = $email;
        $userObj->password = $password;

        if ($userObj->login()) {
            header("Location: ./index.php");
            exit();
        } else {
            $message = $userObj->message;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <title>HubVenue - Login</title>
    <link rel="icon" href="./public/images/white_transparent.png">
    <style>
        .bg {
            background-image: url('./public/images/pexels-creative-vix-7283.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg flex justify-center items-center min-h-screen box-border">
    <form method="POST"
        class="flex flex-col items-center py-4 px-6 overflow-hidden border-2 rounded-2xl border-neutral-600 bg-neutral-200/80 gap-2 shadow-2xl"
        style="width: 400px;">
        <div class="pt-4">
            <img src="./public/images/black_transparent.png" alt="" class="h-24">
        </div>
        <h1 class="font-semibold text-xl">LOGIN FORM</h1>

        <!-- Display error message if available -->
        <?php if (!empty($message)) { ?>
            <div id="error-message"
                class="absolute left-1/2 bg-neutral-200 border-2 border-red-600 p-4 pt-0 rounded-xl overflow-auto w-96 h-fit text-center top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-start shadow-xl text-2xl">
                <button type="button" onclick="document.getElementById('error-message').style.display='none'"
                    class="text-red-600 font-bold w-fit self-end">X</button>
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php } ?>

        <!-- EMAIL Field -->
        <div class="flex flex-col w-full">
            <label for="email" class="font-semibold text-sm">EMAIL</label>
            <input type="text" id="email" name="email" class="px-2 py-1 border" placeholder="Enter Email"
                value="<?php echo htmlspecialchars($email); ?>">
            <span class="text-red-500"><?php echo $emailErr; ?></span>
        </div>

        <!-- PASSWORD Field -->
        <div class="flex flex-col w-full">
            <span class="flex items-center justify-between">
                <label for="password" class="font-semibold text-sm">PASSWORD</label>
                <a href="./pwdRecovery.php" class="text-xs underline underline-offset-2 hover:text-red-500">Forgot
                    Password</a>
            </span>
            <input type="password" id="password" name="password" class="px-1 py-1 border" placeholder="Enter Password">
            <span class="text-red-500"><?php echo $passwordErr; ?></span>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col gap-2 w-1/2 mt-2">
            <input type="submit"
                class="px-3 py-2 border-2 bg-red-500 hover:text-neutral-700 duration-150 hover:bg-red-400 font-semibold text-white rounded-md"
                value="LOGIN">
            <a href="./signup.php"
                class="underline underline-offset-1 text-xs text-center hover:text-red-500 duration-150">Sign Up</a>
            <a href="./index.php"
                class="underline underline-offset-1 text-xs text-center hover:text-red-500 duration-150">View Only</a>
        </div>
    </form>
</body>

</html>