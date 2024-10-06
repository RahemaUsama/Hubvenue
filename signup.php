<?php
require_once './classes/user.class.php';
require_once './sanitize.php';
$userObj = new User();

$message = '';
$first_name = $last_name = $email = $password = "";
$first_nameErr = $last_nameErr = $emailErr = $passwordErr = "";
$gender = $birthday = $middle_initial = $contact = "";
$genderErr = $birthdayErr = $middle_initialErr = $contactErr = "";
$registrationSuccess = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = isset($_POST['first_name']) ? sanitizeInput($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitizeInput($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitizeInput($_POST['password']) : '';
    $gender = isset($_POST['gender']) ? sanitizeInput($_POST['gender']) : '';
    $birthday = isset($_POST['birthday']) ? sanitizeInput($_POST['birthday']) : '';
    $middle_initial = isset($_POST['middle_initial']) ? sanitizeInput($_POST['middle_initial']) : '';
    $contact = isset($_POST['contact']) ? sanitizeInput($_POST['contact']) : '';


    if (empty($first_name)) {
        $first_nameErr = "* Firstname is required";
    }
    if (empty($last_name)) {
        $last_nameErr = "* Lastname is required";
    }
    if (verifyEmail($email) === false) {
        $emailErr = "* Invalid email format";
    }
    if (empty($email)) {
        $emailErr = "* Email is required";
    }
    if (empty($password)) {
        $passwordErr = "* Password is required";
    }
    if (empty($gender)) {
        $genderErr = "* Gender is required";
    }
    if (empty($birthday)) {
        $birthdayErr = "* Birthday is required";
    }
    if (empty($middle_initial)) {
        $middle_initialErr = "* Middle initial is required";
    }
    if (empty($contact)) {
        $contactErr = "* Contact number is required";
    }


    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($genderErr) && empty($birthdayErr) && empty($middle_initialErr) && empty($contactErr)) {
        $userObj->first_name = $first_name;
        $userObj->last_name = $last_name;
        $userObj->email = $email;
        $userObj->password = $password;
        $userObj->gender = $gender;
        $userObj->birthday = $birthday;
        $userObj->middle_initial = $middle_initial;
        $userObj->contact = $contact;

        if ($userObj->register()) {
            $registrationSuccess = true;
            // We'll use JavaScript to show the pop-up and redirect
        } else {
            $message = $userObj->message;
        }
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./output.css?v=1.17">
    <title>HubVenue - Sign Up</title>
    <link rel="icon" href="./public/images/white_transparent.png">
    <style>
        .bg {
            background-image: url('./public/images/pexels-creative-vix-7283.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .rounded-input {
            border-radius: 0.375rem;
        }
    </style>
    <script>
        function showSuccessPopup() {
            alert("Thanks for choosing HubVenue. Account successfully created!");
            window.location.href = "./login.php";
        }
    </script>
</head>

<body class="bg flex justify-center items-center min-h-screen relative box-border">
    <form method="POST"
        class="flex flex-col items-center py-8 px-12 overflow-hidden rounded-2xl bg-neutral-200/80 gap-6 shadow-2xl"
        style="width: 700px;">
        <div class="pb-2">
            <img src="./public/images/black_transparent.png" alt="" class="h-24">
        </div>
        <h1 class="font-semibold text-2xl text-red-600">SIGNUP FORM</h1>
        <?php if (!empty($message)) { ?>
            <div id="error-message"
                class="absolute left-1/2 bg-neutral-200 border-2 border-red-600 p-4 pt-0 rounded-xl overflow-auto w-96 h-fit text-center top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col justify-start shadow-xl text-2xl">
                <button type="button" onclick="document.getElementById('error-message').style.display='none'"
                    class="text-red-600 font-bold w-fit self-end">X</button>
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <div class="grid grid-cols-2 gap-6 w-full px-4">
            <div class="flex flex-col">
                <span class="flex items-center justify-between mb-1">
                    <label for="first_name" class="font-semibold text-sm">FIRST NAME</label>
                    <span class="text-red-500"><?php echo $first_nameErr; ?></span>
                </span>
                <input type="text" class="px-3 py-2 rounded-input w-full" placeholder="Enter First Name" name="first_name"
                    value="<?php echo htmlspecialchars($first_name); ?>">
            </div>

            <div class="flex flex-col">
                <span class="flex items-center justify-between mb-1">
                    <label for="last_name" class="font-semibold text-sm">LAST NAME</label>
                    <span class="text-red-500"><?php echo $last_nameErr; ?></span>
                </span>
                <input type="text" class="px-3 py-2 rounded-input w-full" placeholder="Enter Last Name" name="last_name"
                    value="<?php echo htmlspecialchars($last_name); ?>">
            </div>

            <div class="flex flex-col">
                <span class="flex items-center justify-between mb-1">
                    <label for="middle_initial" class="font-semibold text-sm">M.I.</label>
                    <span class="text-red-500"><?php echo $middle_initialErr; ?></span>
                </span>
                <input type="text" class="px-3 py-2 rounded-input w-full" placeholder="M.I." name="middle_initial" maxlength="1"
                    value="<?php echo htmlspecialchars($middle_initial); ?>">
            </div>

            <div class="flex flex-col">
                <span class="flex items-center justify-between mb-1">
                    <label for="gender" class="font-semibold text-sm">GENDER</label>
                    <span class="text-red-500"><?php echo $genderErr; ?></span>
                </span>
                <select name="gender" class="px-3 py-2 rounded-input w-full">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="male" <?php echo ($gender === 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ($gender === 'female') ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>

            <div class="flex flex-col">
                <span class="flex items-center justify-between mb-1">
                    <label for="birthday" class="font-semibold text-sm">BIRTHDAY</label>
                    <span class="text-red-500"><?php echo $birthdayErr; ?></span>
                </span>
                <input type="date" class="px-3 py-2 rounded-input w-full" name="birthday"
                    value="<?php echo htmlspecialchars($birthday); ?>">
            </div>

            <div class="flex flex-col">
                <span class="flex items-center justify-between mb-1">
                    <label for="contact" class="font-semibold text-sm">CONTACT NUMBER</label>
                    <span class="text-red-500"><?php echo $contactErr; ?></span>
                </span>
                <input type="tel" class="px-3 py-2 rounded-input w-full" placeholder="Enter Contact Number" name="contact"
                    value="<?php echo htmlspecialchars($contact); ?>">
            </div>
        </div>

        <div class="flex flex-col w-full px-4">
            <span class="flex items-center justify-between mb-1">
                <label for="email" class="font-semibold text-sm">EMAIL</label>
                <span class="text-red-500"><?php echo $emailErr; ?></span>
            </span>
            <input type="text" class="px-3 py-2 rounded-input w-full" placeholder="Enter Email" name="email"
                value="<?php echo htmlspecialchars($email); ?>">
        </div>

        <div class="flex flex-col w-full px-4">
            <span class="flex items-center justify-between mb-1">
                <label for="password" class="font-semibold text-sm">PASSWORD</label>
                <span class="text-red-500"><?php echo $passwordErr; ?></span>
            </span>
            <input type="password" class="px-3 py-2 rounded-input w-full" placeholder="Enter Password" name="password"
                value="<?php echo htmlspecialchars($password); ?>">
        </div>

        <div class="flex items-center w-full mt-2 px-4">
            <input type="checkbox" id="terms" name="terms" required class="mr-2">
            <label for="terms" class="text-sm">
                I agree with all the <a href="#" class="text-red-600 hover:underline">terms and conditions</a> and 
                <a href="#" class="text-red-600 hover:underline">privacy policies</a> of HubVenue
            </label>
        </div>

        <div class="flex flex-col gap-2 mt-2 w-full px-4">
            <input type="submit"
                class="px-3 py-2 bg-red-500 hover:bg-red-400 font-semibold text-white rounded-md cursor-pointer"
                value="SIGN UP">
        </div>

        <a href="./login.php"
            class="text-sm font-medium text-red-600 hover:text-red-800 hover:underline">Back to Login</a>
    </form>
    <?php if ($registrationSuccess): ?>
    <script>
        showSuccessPopup();
    </script>
    <?php endif; ?>
</body>

</html>