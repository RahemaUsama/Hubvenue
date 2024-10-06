<?php
require_once './authmiddleware.php';
require_once './classes/property.class.php';
require_once './classes/saved.property.class.php';

$propertyObj = new Property();
$saveobj = new Save();

// checkAuth();

// Initialize variables for the form data
$location = '';
$price = '';
$search = '';
$properties = []; // Initialize an empty array for properties

// Fetch properties based on user input
$properties = $propertyObj->viewProp();

//initailize the saved properties variable
$savedProperties = [];

// Remove numeric keys from the array
$filteredProperties = array_map(function ($property) {
    return [
        'propertyId' => $property['propertyId']
    ];
}, $savedProperties);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HubVenue</title>
    <link rel="icon" href="./public/images/white_transparent.png">
    <link rel="stylesheet" href="./output.css?v=1.15">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .custom-gradient {
            background: linear-gradient(to top, rgba(71, 69, 69, 0.9), rgba(75, 85, 99, 0));
        }
    </style>
</head>

<body class="bg-neutral-100 text-neutral-700 box-border">
    <?php require_once './components/Navbar.php'; ?>

    <section
        class="mx-auto flex flex-col items-center mb-4 md:mb-8 min-h-[800px] lg:min-h-0 lg:h-[85vh] overflow-hidden">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 shadow-lg shadow-neutral-200/5 flex-1">
            <div class="relative overflow-hidden w-full sm:mt-0 mx-auto z-30 lg:h-[85vh]">
                <!-- Image Container -->
                <div id="carousel" class="flex transition-transform duration-500 h-full ">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="./public/bgimages/Inside Weddings.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="./public/bgimages/Modern And Minimalistic Museo Casa de la Bola Wedding.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="./public/bgimages/Red and white rustic wedding venue  decor with lanterns.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="./public/bgimages/marc-babin-aQWmCH_b3MU-unsplash.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="./public/bgimages/Rent Party & Event Items Portland OR.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="./public/bgimages/Black Plates & Red Roses at Head Table.jpg" alt="">
                    <img class="h-full w-full flex-shrink-0 opacity-90 object-cover"
                        src="./public/bgimages/elegant black tablescape with red roses; Ralph Lauren dinner.jpg" alt="">
                </div>

                <!-- Dots Navigation -->
                <div class="absolute bottom-4 left-1/2 transform z-30 -translate-x-1/2 flex space-x-2">
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                    <div class="dot w-2 h-2 bg-neutral-800 rounded-full cursor-pointer"></div>
                </div>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20 border p-2">
                <span class="text-center my-auto flex flex-col gap-2 ">
                    <h1 class="text-3xl font-semibold md:text-4xl ">Welcome to <span
                            class="text-red-500 italic">HubVenue!</span></h1>
                    <h3 class="sm:text-xl">"Discover Our Venue: A Perfect Setting <br> for Every Occasion"</h3>
                    <p class="sm:block hidden md:text-lg md:px-4">Discover the perfect setting for your most
                        memorable
                        events.
                        At HubVenue, we believe every occasion deserves a beautiful backdrop, whether it's a
                        wedding,
                        corporate gathering, or an intimate celebration. Nestled in a picturesque location. With
                        customizable spaces, state-of-the-art facilities, and a dedicated team to assist you,
                        HubVenue
                        is more than just a place—it's where your dreams come to life. Come explore our versatile
                        venue
                        and let us be the host to your next cherished moment.</p>
                </span>
            </div>
        </div>
    </section>

    <section class="container mx-auto flex flex-col items-center mb-4 md:mb-8 ">
        <h2 class="text-3xl lg:text-5xl font-bold mt-4">Our Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
            <div class="flex flex-col items-center bg-neutral-200/20  border p-4 rounded-lg shadow-lg m-4">
                <img src="./public/serviceimages/pexels-pixabay-267569.jpg" alt="Rent Space" class="w-full">
                <h3 class="text-xl font-semibold mt-2 text-center">Space Rentals</h3>
                <p class="text-center">Discover unique spaces for any event, from intimate gatherings to large-scale
                    functions.</p>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20  border p-4 rounded-lg shadow-lg m-4">
                <img src="./public/serviceimages/pexels-rdne-7414284.jpg" alt="Post Listings" class="w-full">
                <h3 class="text-xl font-semibold mt-2 text-center">Post Your Space</h3>
                <p class="text-center">Earn money by listing your home or commercial space for event rentals.</p>
            </div>
            <div class="flex flex-col items-center bg-neutral-200/20  border p-4 rounded-lg shadow-lg m-4">
                <img src="./public/serviceimages/pexels-tima-miroshnichenko-6694575.jpg" alt="Book Event"
                    class="w-full">
                <h3 class="text-xl font-semibold mt-2 text-center">Book an Event Space</h3>
                <p class="text-center">Easily browse and book spaces for weddings, meetings, parties, and more.</p>
            </div>
        </div>
    </section>

    <section class="properties-list container mx-auto flex flex-col items-center mb-4 md:mb-8">
        <h2 class="text-3xl lg:text-5xl font-bold mt-4 mb-2">Rental Properties</h2>

        <div class="flex flex-col gap-4 md:gap-8 bg-neutral-200/20 border shadow-lg p-4 lg:p-8 m-4 rounded-lg w-full min-h-30">
            <!-- HTML form to search properties -->
            <form id="searchForm" class="text-neutral-900 flex gap-2 justify-center w-full">
                <div class="flex">
                    <select class="p-1 py-2 w-20 lg:w-36 bg-neutral-100 border-2 rounded-lg text-neutral-900"
                        name="location" id="location">
                        <option value="">Select Location</option>
                        <?php
                        $locationlist = $propertyObj->fetchlocation();
                        foreach ($locationlist as $loc) {
                            ?>
                            <option value="<?= $loc['location'] ?>" <?= ($location == $loc['location']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($loc['location']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="flex">
                    <select class="p-1 py-2 w-20 md:w-36 bg-neutral-100 rounded-lg border-2 text-neutral-900"
                        name="price" id="price">
                        <option value="">Select Price</option>
                        <?php
                        $pricelist = $propertyObj->fetchprice();
                        foreach ($pricelist as $pri) {
                            ?>
                            <option value="<?= $pri['price'] ?>" <?= ($price == $pri['price']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($pri['price']) ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="flex w-1/2 relative">
                    <input placeholder="Search for a Unit"
                        class="outline-0 p-1 py-2 border-2 bg-neutral-100 rounded-lg w-full" type="text" id="search"
                        name="search" value="<?= htmlspecialchars($search) ?>">
                    <button id="submit" type="submit" value="Search"
                        class="absolute top-1/2 -translate-y-1/2 right-2 cursor-pointer" value="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </div>

            </form>

            <div id="result" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6  rounded-xl">

<?php if (!empty($properties)): ?>
    <?php foreach ($properties as $property): ?>
        <div class="property-item shadow-sm hover:-translate-y-2 ease-out overflow-hidden rounded-lg relative shadow-neutral-50 duration-500 group">
            <svg class="opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-40 absolute left-1/2 top-1/2 text-red-500 -translate-y-1/2 -translate-x-1/2"
                xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-eye"
                viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
            </svg>

                             <div class="w-full relative overflow-hidden flex items-center h-[350px]" style="height: 350px;">
                                <img class="" src="<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image">

                                <div class="cursor-pointer flex gap-2 flex-col items-start p-4 absolute custom-gradient h-full top-0 w-full justify-between">
                                    <div class="flex justify-between items-center w-full">
                                        <div class="bg-neutral-200 rounded-full flex items-center p-1">
                                            <div class="bg-red-500 rounded-full p-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="text-neutral-100" width="16"
                                                    height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                                    <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                                </svg>
                                            </div>
                                            <p class="font-semibold text-neutral-600/70 text-sm p-1">
                                                Starts at ₱<?php echo htmlspecialchars($property['price']); ?>
                                            </p>
                                        </div>
                                    </div>
                                        <!-- bookmark -->



                                        <div class="w-full">
                                        <div class="flex flex-col justify-center items-start">
                                            <a href="./property.php?id=<?php echo $property['p_id']; ?>" class="text-3xl font-semibold text-red-500 hover:underline">
                                                <?php echo htmlspecialchars($property['property_name']); ?>
                                            </a>
                                            <p class="text-neutral-200">
                                                <?php echo htmlspecialchars($property['location']); ?>
                                            </p>
                                            <p class="text-neutral-200">
                                                Area: <?php echo htmlspecialchars($property['area'] ?? 'N/A'); ?> sqm
                                            </p>
                                            <p class="text-neutral-200">
                                                Venue Type: <?php echo htmlspecialchars($property['venue_type'] ?? 'N/A'); ?>
                                            </p>
                                            <a href="./property.php?id=<?php echo $property['p_id']; ?>" class="text-lg font-semibold text-neutral-200 hover:underline mt-2">
                                                <?php echo htmlspecialchars($property['property_name']); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-red-500">No properties found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="container mx-auto flex flex-col items-center mb-8 ">
        <h2 class="text-3xl lg:text-5xl font-semibold mt-8 mb-2">About Us</h2>

        <div class="flex flex-col gap-4 m-4">

            <div class="flex flex-col items-center bg-neutral-200/20 border p-4 lg:p-8 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold  text-red-500 italic">Our Story</h3>
                <p>
                    Hubvenue was born out of the need to streamline the often complex and time-consuming process of
                    event
                    planning. The journey began when our founders, faced with the daunting task of organizing
                    multiple
                    events, realized how fragmented the venue and catering service industry was. From endless phone
                    calls to
                    lengthy negotiations, the process was anything but easy. Inspired by the vision of a one-stop
                    platform,
                    Hubvenue was developed to centralize and simplify these interactions, allowing users to focus on
                    creating memorable experiences instead of logistics.
                </p>
                <br>
                <p>Throughout our journey, we faced challenges, such as integrating diverse services and building
                    trust
                    within the community. However, these obstacles only strengthened our commitment to innovation.
                    Hubvenue
                    continues to grow, expanding our network of partners and refining our platform based on user
                    feedback,
                    making it the ultimate event planning tool for everyone.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- mission -->
                <div class="flex flex-col items-center bg-neutral-200/20 border p-4 lg:p-8 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold  text-red-500 italic">Our Mission</h3>
                    <p class="text-center">
                        To simplify finding and booking available venues, offering users an easy and efficient platform
                        that connects them with ideal spaces for their events, ensuring seamless experience from
                        discovery ro registration.
                    </p>
                </div>
                <!-- vission -->
                <div class="flex flex-col items-center bg-neutral-200/20 border p-4 lg:p-8 rounded-lg shadow-lg">
                    <h3 class="text-xl font-semibold  text-red-500 italic">Our Vision</h3>
                    <p class="text-center">
                        To be the go to platform for venue reservations, helping people connect with the perfect spaces
                        for any event.
                    </p>
                </div>
            </div>

            <!-- FAQ -->
            <div class="flex flex-col bg-neutral-200/20 border text-neutral-700 p-4 lg:p-8 rounded-lg shadow-lg">
                <h3 class="text-xl font-semibold text-red-500 italic text-center">FAQs</h3>
                <div class="w-full ">
                    <div class="faq-item mb-4">
                        <button class="faq-header w-full text-left">
                            1. How do I book a space?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class="text-xs">To book a space, simply look for your desired
                                location
                                and
                                date on our platform. Browse
                                through the available options, select the space that suits your needs, and follow
                                the
                                booking process to confirm your reservation.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header  w-full text-left">
                            2. Can I list my own space on HubVenue?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class=" text-xs">Yes, you can list your space on HubVenue. Create an
                                account,
                                provide details about your
                                space, upload photos, and set your availability and pricing. Once your listing is
                                approved, it will be visible to potential renters.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header  w-full text-left">
                            3. What types of spaces can I list?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class=" text-xs">You can list a variety of spaces including
                                residential
                                homes,
                                commercial venues, event
                                halls, and more. The platform is designed to accommodate all types of spaces that
                                can be
                                used for events and gatherings.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header  w-full text-left">
                            4. Are there any fees associated with booking or listing a space?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class=" text-xs">Yes, there may be fees associated with both booking
                                and
                                listing
                                spaces. Booking fees are
                                typically a percentage of the total rental cost, while listing fees may vary based
                                on
                                the type of space and duration of the listing. Detailed information about fees will
                                be
                                provided during the booking or listing process.</p>
                        </div>
                    </div>
                    <div class="faq-item mb-4">
                        <button class="faq-header  w-full text-left">
                            5. How can I contact customer support?
                        </button>
                        <div class="faq-content hidden text-center">
                            <p class=" text-xs">If you need assistance, you can contact our customer
                                support
                                team via the contact form on
                                our website, or by email at info@hubvenue.com. Our team is available to help you
                                with
                                any questions or issues you may have.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <?php require_once './components/Footer.php' ?>

    <script src="./js/submit.js"></script>
    <script>
        $(document).ready(function () {
            $('#searchForm').on('submit', function (event) {
                event.preventDefault(); // Prevent form from refreshing the page
                console.log("clicked");

                $.ajax({
                    url: 'api/searchsubmit.api.php', // The PHP file that will handle the search
                    type: 'POST',
                    data: $(this).serialize(), // Serialize the form data (location, price, search)
                    success: function (response) {
                        // Populate the results in the #searchResults div
                        $('#result').html(response);
                    },
                    error: function (xhr, status, error) {
                        // Handle error
                        console.error("Error: " + error);
                    }
                });
            });
        });
    </script>


</body>

</html>