<?php

require_once './authmiddleware.php';
require_once './classes/profile.class.php';

$profileobj = new Profile();

$profileinfo = $profileobj->fetchprofile();

checkAuth();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" href="./public/images/white_transparent.png">
    <link rel="stylesheet" href="./output.css?v=1.14">
</head>

<body
    class="bg-neutral-100 text-neutral-700 flex relative justify-center items-center box-border lg:h-screen lg:overflow-hidden">

    <div
        class="p-4 w-full lg:w-[1000px] bg-neutral-200 flex flex-col relative h-screen lg:grid lg:grid-cols-2 gap-4 lg:h-[600px] rounded-md ">

        <!-- upload_property_form -->
        <div class="fixed left-0 top-0 bg-neutral-700/80 h-screen w-screen z-50 hidden" id="upload_property_form">
            <form action="upload_property.php" class="absolute bg-neutral-100 z-50 w-[90%] max-w-3xl text-neutral-800 left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 p-6 rounded-md flex flex-col gap-4" method="POST" enctype="multipart/form-data">
                <h1 class="font-bold text-2xl text-center">VENUE UPLOAD FORM</h1>

                <span class="text-red-500 absolute top-4 right-4 cursor-pointer" id="close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </span>

                <!-- Progress Bar and Steps -->
                <div class="mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="text-sm font-medium">Venue Information - Step <span id="current-step">1</span> of 3</span>
                        <span class="text-sm font-medium" id="progress-percentage">33%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full transition-all duration-300 ease-in-out" style="width: 33%" id="progress-bar"></div>
                    </div>
                </div>

                <!-- Part 1: Basic Information -->
                <div id="part1" class="space-y-4">
                    <h2 class="font-semibold text-lg">Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="venue_name" class="font-semibold">Venue Name <span class="text-red-500">*</span></label>
                            <input type="text" name="venue_name" class="px-3 py-2 border rounded" required>
                        </div>
                        <div class="flex flex-col">
                            <label for="venue_location" class="font-semibold">Venue Location <span class="text-red-500">*</span></label>
                            <input type="text" name="venue_location" class="px-3 py-2 border rounded" required>
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label for="venue_description" class="font-semibold">Venue Description <span class="text-red-500">*</span></label>
                            <textarea name="venue_description" rows="4" class="px-3 py-2 border rounded resize-none" required></textarea>
                        </div>
                        <div class="flex flex-col">
                            <label for="amenities" class="font-semibold">Amenities (comma-separated)</label>
                            <input type="text" name="amenities" class="px-3 py-2 border rounded">
                        </div>
                        <div class="flex flex-col">
                            <label for="price" class="font-semibold">Price <span class="text-red-500">*</span></label>
                            <input type="number" name="price" class="px-3 py-2 border rounded" required>
                        </div>
                    </div>
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full" data-part="2">Next</button>
                </div>

                <!-- Part 2: Additional Details -->
                <div id="part2" class="space-y-4 hidden">
                    <h2 class="font-semibold text-lg">Additional Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="availability" class="font-semibold">Availability</label>
                            <input type="text" name="availability" class="px-3 py-2 border rounded">
                        </div>
                        <div class="flex flex-col">
                            <label for="capacity" class="font-semibold">Capacity</label>
                            <input type="number" name="capacity" class="px-3 py-2 border rounded">
                        </div>
                        <div class="flex flex-col">
                            <label for="category" class="font-semibold">Category</label>
                            <select name="category" class="px-3 py-2 border rounded">
                                <option value="wedding">Wedding</option>
                                <option value="conference">Conference</option>
                                <option value="party">Party Hall</option>
                            </select>
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label for="images" class="font-semibold">Images (Multiple)</label>
                            <input type="file" name="images[]" id="images" multiple accept="image/*" class="px-3 py-2 border rounded">
                            <div id="image-preview" class="mt-2 flex flex-wrap gap-2"></div>
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label for="video" class="font-semibold">Video</label>
                            <input type="file" name="video" id="video" accept="video/*" class="px-3 py-2 border rounded">
                            <div id="video-preview" class="mt-2"></div>
                        </div>
                        <div class="flex flex-col">
                            <label for="contact" class="font-semibold">Contact Information</label>
                            <input type="text" name="contact" class="px-3 py-2 border rounded">
                        </div>
                    </div>
                    <div class="flex justify-between gap-4">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 flex-1" data-part="1">Previous</button>
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex-1" data-part="3">Next</button>
                    </div>
                </div>

                <!-- Part 3: Venue Features and Policies -->
                <div id="part3" class="space-y-4 hidden">
                    <h2 class="font-semibold text-lg">Venue Features and Policies</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="accessibility" class="font-semibold">Accessibility Features</label>
                            <select name="accessibility" multiple class="px-3 py-2 border rounded">
                                <option value="wheelchair">Wheelchair Access</option>
                                <option value="elevator">Elevator</option>
                                <option value="ramp">Ramp</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label for="parking" class="font-semibold">Parking Spaces</label>
                            <input type="number" name="parking" class="px-3 py-2 border rounded">
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label for="rules" class="font-semibold">Venue Rules/Policies</label>
                            <textarea name="rules" rows="3" class="px-3 py-2 border rounded resize-none"></textarea>
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label for="cancellation" class="font-semibold">Cancellation Policy</label>
                            <textarea name="cancellation" rows="3" class="px-3 py-2 border rounded resize-none"></textarea>
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label for="pricing_packages" class="font-semibold">Custom Pricing Packages</label>
                            <textarea name="pricing_packages" rows="3" class="px-3 py-2 border rounded resize-none"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-between gap-4">
                        <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 flex-1" data-part="2">Previous</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex-1">Submit</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Profile section -->
        <div class="flex flex-col relative items-center justify-start p-6 space-y-4 lg:h-full pb-0">
            <div
                class="fixed left-0 top-0 p-7 bg-neutral-300 lg:p-0 z-40 lg:absolute lg:left-[2px] lg:top-[2px] w-full h-fit">
                <button onclick="window.location.href = './index.php';"
                    class="fixed left-[5px] top-[14px] lg:absolute lg:left-[2px] lg:top-[2px] hover:text-red-500 duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                </button>
            </div>

            <div class="flex flex-col items-center h-full justify-center gap-4 relative  w-full ">

                <!-- image placeholder -->
                <div class="relative w-52 h-52 cursor-pointer border border-gray-300 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center"
                    id="uploadbtn">
                    <img src="<?= isset($profileinfo['profile_pic_url']) && $profileinfo['profile_pic_url'] ? $profileinfo['profile_pic_url'] : './public/others/placeholder-400x400.jpg'; ?>"
                        alt="Profile Picture" class="object-cover w-full h-full" id="profilePicture">
                </div>

                <!-- upload_profile_picture_form -->
                <form action="profile_upload.php"
                    class="absolute bg-neutral-100 text-neutral-800 gap-2 left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2 p-4 rounded-md hidden"
                    id="upload_form" method="POST" enctype="multipart/form-data">
                    <label for="profile_pic" class="font-semibold">Upload Profile Picture</label>
                    <input type="file" name="profile_pic" accept="image/*" required>
                    <input type="submit" class="bg-neutral-700 text-neutral-100 p-2 rounded-md"
                        value="Upload Image"></input>
                </form>


                <div class="text-center">
                    <div class="text-lg font-bold capitalize leading-[.50rem]">
                        <p><?= $profileinfo['first_name'] ?> <?= $profileinfo['last_name'] ?> </p>
                        <br>
                        <span class="capitalize text-sm font-normal"
                            id="usertype"><?= $profileinfo['usertype'] ?></span>
                    </div>
                </div>


               
                                      
                <div class="property-item shadow-sm border md:max-w-[500px] ease-out overflow-hidden rounded-lg mt-2 w-[93%] mx-auto relative shadow-neutral-50 group hidden h-[50px] bg-neutral-400"
                    id="post_trigger">
                    <div class="w-full relative overflow-hidden flex items-center group justify-center">
                        <button
                            class="duration-200 cursor-pointer group-hover:scale-105 group-hover:text-neutral-200 flex items-center gap-2 p-2 rounded-md"
                            id="post_trigger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-plus-square" viewBox="0 0 16 16">
                                <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                            </svg>
                            <p class="font-semibold">Post New Property</p>
                        </button>
                    </div>
                </div>
                <div class="w-full border border-gray-400 rounded-md flex justify-evenly relative md:max-w-[500px]">
                    <!-- Posted -->
                    <?php
                    if ($profileinfo['usertype'] == 'client'): ?>
                        <span class="text-center leading-3 mt-1 mb-2">
                            <h1 class="font-semibold text-lg"><?= $profileinfo["posted"] ?></h1>
                            <p class="text-xs">Posted</p>
                        </span>
                        <div class="w-px bg-gray-400 h-full"></div>
                    <?php endif;
                    ?>

                    <!-- Divider -->


                    <!-- Booked -->
                    <span class="text-center leading-3 mt-1 mb-2">
                        <h1 class="font-semibold text-lg"><?= $profileinfo['booked'] ?></h1>
                        <p class="text-xs">Booked</p>
                    </span>

                    <!-- Divider -->
                    <div class="w-px bg-gray-400 h-full"></div>

                    <!-- Saved -->
                    <span class="text-center leading-3 mt-1 mb-2">
                        <h1 class="font-semibold text-lg"><?= $profileinfo['saved'] ?></h1>
                        <p class="text-xs">Saved</p>
                    </span>
                </div>


            </div>

            <!-- 
            <form action="upload.php" method="post" enctype="multipart/form-data" class="flex flex-col items-center space-y-2">
                <input type="file" name="profilePicture" id="profilePictureInput" class="hidden">
                <button type="button" id="uploadButton" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition-colors">Upload</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">Submit</button>
            </form>
            -->
        </div>

        <!-- Rents and Saved section -->
        <div>
            <div class="bg-neutral-300 rounded-md overflow-hidden flex justify-center max-w-[500px] mx-auto">
                <button id="posted" class="text-sm py-1 text-center flex-1 w-full h-full">Posted</button>
                <button id="rents" class="text-sm py-1 text-center flex-1 w-full h-full">Rents</button>
                <button id="saved" class="text-sm py-1 text-center flex-1 w-full h-full">Saved</button>
            </div>

            <div class="flex flex-col lg:h-[530px] lg:overflow-y-auto ">

                <!-- Inner container without fixed height -->
                <div id="profiledisp"
                    class="mt-2 flex flex-col items-center max-w-[500px] mx-auto gap-4 text-neutral-700">

                </div>

            </div>
        </div>



    </div>

    <script src="./js/profile.js"></script>
    <script>
        // Define showPart function globally
        function showPart(partNumber) {
            const parts = [
                document.getElementById('part1'),
                document.getElementById('part2'),
                document.getElementById('part3')
            ];
            const progressBar = document.getElementById('progress-bar');
            const currentStep = document.getElementById('current-step');
            const progressPercentage = document.getElementById('progress-percentage');

            parts.forEach((part, index) => {
                if (index + 1 === partNumber) {
                    part.classList.remove('hidden');
                } else {
                    part.classList.add('hidden');
                }
            });

            const percentage = Math.round((partNumber / 3) * 100);
            const width = `${percentage}%`;
            progressBar.style.width = width;
            currentStep.textContent = partNumber;
            progressPercentage.textContent = `${percentage}%`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners to navigation buttons
            document.querySelectorAll('[data-part]').forEach(button => {
                button.addEventListener('click', function() {
                    showPart(parseInt(this.dataset.part));
                });
            });

            // JavaScript to trigger file upload and change button opacity
            document.getElementById('imgtrigg').addEventListener('click', (e) => {
                e.preventDefault();  // Prevent the default button behavior
                e.target.classList.add('opacity-0');  // Add the 'opacity-0' class to the button
                document.getElementById('property_pic').click();  // Trigger file input click
            });

            // JavaScript to display the image when a file is selected
            document.getElementById('property_pic').addEventListener('change', function (event) {
                const file = event.target.files[0];
                const preview = document.getElementById('property_pic_preview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        preview.classList.add('block');
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '';
                }
            });

            document.getElementById('close').addEventListener('click', function() {
                document.getElementById('upload_property_form').classList.add('hidden');
            });

            // Handle multiple image preview
            document.getElementById('images').addEventListener('change', function(event) {
                const preview = document.getElementById('image-preview');
                preview.innerHTML = ''; // Clear previous previews
                
                Array.from(event.target.files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'w-24 h-24 object-cover rounded';
                            preview.appendChild(img);
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Handle video preview
            document.getElementById('video').addEventListener('change', function(event) {
                const preview = document.getElementById('video-preview');
                preview.innerHTML = ''; // Clear previous preview
                
                const file = event.target.files[0];
                if (file && file.type.startsWith('video/')) {
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.className = 'w-full max-w-md mt-2';
                    video.controls = true;
                    preview.appendChild(video);
                }
            });
        });
    </script>


</body>

</html>