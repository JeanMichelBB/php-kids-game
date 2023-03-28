<?php

    include('./components/components.php');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <?php 
        $isLoggedIn = TRUE; // TODO - Change this to TRUE when the user is logged in
        if (!$isLoggedIn) {
            header('Location: login.php');
        }
        createHeader();
        createNav();
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Level
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="inputText">Type the numbers and letters:</label>
                                <input type="text" class="form-control" id="inputText" placeholder="e.g. 12abc">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <div class="mt-3">
                            <p id="result"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php createFooter(); ?>
    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        const form = document.querySelector('form');
        const input = document.querySelector('#inputText');
        const result = document.querySelector('#result');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const text = input.value;
            const display = text.split('').join(', ');
            const numbers = [];
            const letters = [];

            for (let i = 0; i < text.length; i++) {
                const char = text.charAt(i);
                if (/\d/.test(char)) {
                    numbers.push(char);
                } else if (/[a-zA-Z]/.test(char)) {
                    letters.push(char);
                }
            }

            if (numbers.length === 0 && letters.length === 0) {
                result.innerText = 'Please enter some numbers or letters.';
            } else if (numbers.length !== text.length && letters.length !== text.length) {
                result.innerText = `Incorrect – All the characters you entered are different than the ones displayed (${display}).`;
            } else if (numbers.length !== text.length || letters.length !== text.length) {
                result.innerText = `Incorrect – Some of the characters you entered are different than the ones displayed (${display}).`;
            } else if (text.split('').sort().join('') !== text) {
                result.innerText = `Incorrect – The characters you entered are not correctly ordered (${display}).`;
            } else {
                result.innerText = `Correct – The characters you entered (${display}) are correct and in the correct order!`;
            }
        });


    </script>
</body>

</html>