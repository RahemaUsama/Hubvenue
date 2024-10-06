<?php
require_once 'dbconnection.php';
require_once 'functions.php';

// Create a new Database instance and connect
$database = new Database();
$conn = $database->connect();

// Check if the connection is established
if (!$conn) {
    die("Database connection failed. Please check your dbconnection.php file.");
}

// Set the user ID to 1
$userId = 1;

// Pass the $conn variable to getUserData function
$user = getUserData($conn, $userId);

if (!$user) {
    // Provide sample data if user not found
    $user = [
        'name' => 'Sample User',
        'location' => 'Sample Location',
        'about' => 'This is a sample about section.',
        'profile_image' => 'https://via.placeholder.com/100',
        'reviews_count' => 0,
        'rating' => 'N/A',
        'years_hosting' => 0
    ];
}

// Fetch user's listings
$stmt = $conn->prepare("SELECT * FROM properties WHERE userId = :userId");
$stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
$stmt->execute();
$listings = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($user['name'] ?? 'Unknown'); ?>'s Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row">
            <!-- Profile Sidebar -->
            <div class="md:w-1/3 pr-6">
                <div class="bg-white rounded-lg shadow-lg p-4 mb-4 text-center">
                    <img src="<?php echo htmlspecialchars($user['profile_image'] ?? 'https://via.placeholder.com/100'); ?>" alt="<?php echo htmlspecialchars($user['name'] ?? 'Unknown'); ?>" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h2 class="text-2xl font-bold"><?php echo htmlspecialchars($user['name'] ?? 'Unknown'); ?></h2>
                    <p class="text-gray-600">Host</p>
                    <div class="flex justify-around mt-4 text-sm">
                        <div class="text-center">
                            <p class="font-bold"><?php echo $user['reviews_count'] ?? 0; ?></p>
                            <p class="text-gray-600">Review<?php echo $user['reviews_count'] != 1 ? 's' : ''; ?></p>
                        </div>
                        <div class="text-center">
                            <p class="font-bold"><?php echo $user['rating'] ?? 'N/A'; ?>★</p>
                            <p class="text-gray-600">Rating</p>
                        </div>
                        <div class="text-center">
                            <p class="font-bold"><?php echo $user['years_hosting'] ?? 0; ?></p>
                            <p class="text-gray-600">Years hosting</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-4 mb-4">
                    <h3 class="font-bold mb-2">Confirmed information</h3>
                    <ul class="space-y-1">
                        <li class="flex items-center"><svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Identity</li>
                        <li class="flex items-center"><svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Email address</li>
                        <li class="flex items-center"><svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Phone number</li>
                    </ul>
                </div>
                
                <a href="#" class="text-sm text-gray-600 hover:underline">Report this profile</a>
            </div>
            
            <!-- Profile Main Content -->
            <div class="md:w-2/3 mt-6 md:mt-0">
                <h2 class="text-2xl font-bold mb-4">About <?php echo htmlspecialchars($user['name'] ?? 'Unknown'); ?></h2>
                <p class="mb-2"><svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Lives in <?php echo htmlspecialchars($user['location'] ?? 'Unknown'); ?></p>
                <p class="mb-6"><?php echo htmlspecialchars($user['about'] ?? 'As the oldest of five, I was a little bit of an instigator back in the day (and perhaps not the most accommodating), generally seeking to torment my kid siblings. But I’ve grown up, and I’d be happy to share my childhood home – my pizza, even – with you this holiday season.'); ?></p>
                
                <h3 class="text-xl font-bold mb-4"><?php echo htmlspecialchars($user['name'] ?? 'Unknown'); ?>'s reviews</h3>
                <div x-data="{ showAllReviews: false }">
                    <!-- Display reviews here (you'll need to fetch and loop through reviews) -->
                    <button @click="showAllReviews = !showAllReviews" class="text-blue-600 hover:underline mb-6">
                        <span x-show="!showAllReviews">Show all reviews</span>
                        <span x-show="showAllReviews">Hide reviews</span>
                    </button>
                    <div x-show="showAllReviews" class="space-y-4">
                        <!-- Additional reviews would go here -->
                    </div>
                </div>
                
                <h3 class="text-xl font-bold mb-4"><?php echo htmlspecialchars($user['name'] ?? 'Unknown'); ?>'s listings</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($listings as $property): ?>
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="<?php echo htmlspecialchars($property['image_url'] ?? 'https://via.placeholder.com/300x200'); ?>" alt="<?php echo htmlspecialchars($property['property_name']); ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
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
                    <?php endforeach; ?>
                </div>
                
                <!-- Sample Bio -->
                <div class="mt-6 bg-white rounded-lg shadow-lg p-4">
                    <p class="text-gray-700">
                        As the oldest of five, I was a little bit of an instigator back in the day (and perhaps not the most accommodating), generally seeking to torment my kid siblings. But I’ve grown up, and I’d be happy to share my childhood home – my pizza, even – with you this holiday season.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>