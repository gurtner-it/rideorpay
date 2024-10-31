@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">

    <!-- Goal Setting Wizard -->
    <div id="wizard" class="mt-4">

        <!-- Step 0: Connect with Strava -->
        <div id="step0" class="wizard-step p-6 bg-white rounded-lg text-center @if(session('strava_access_token')) hidden @endif">
            <h2 class="text-2xl font-bold text-gray-900">Connect with Strava</h2>
            
            <!-- Current Average Display -->
            <p class="text-gray-400 mb-10">
                Import your rides to start...
            </p>

            <a href="{{ route('strava.redirect') }}" class="w-full max-w-md mx-auto block bg-orange-600 text-white py-2 rounded-lg text-center hover:bg-orange-700">
                Connect to Strava
            </a>
        </div>

        <!-- Step 1: Set Weekly Goal -->
        <div id="step1" class="wizard-step p-6 bg-white rounded-lg text-center @if(!session('strava_access_token')) hidden @endif">
            <h2 class="text-2xl font-bold text-gray-900">🔥 Set Your Weekly Goal</h2>
            
            <!-- Current Average Display -->
            <p class="text-gray-400 mb-10">
                Current weekly average: <strong>{{ $averageMovingTime }} hrs</strong>
            </p>

            <!-- Discount Reward (Hidden Initially) -->
            <div id="discountContainer" class="max-w-md mx-auto p-4 py-4 bg-amber-50 rounded-lg border border-amber-400 mb-4 hidden">
                <p id="discountMessage" class="text-lg text-amber-700"></p>
            </div>

            <!-- Target Hours Selection -->
            <div id="targetHoursContainer" class="max-w-md mx-auto p-4 bg-blue-50 rounded-lg border border-blue-400 mb-4">
                <p class="text-lg font-semibold text-blue-700 mb-2">Your Target</p>
                <input type="range" name="target_hours" id="target_hours" min="0" max="24" step="1" 
                       value="{{ $averageMovingTime }}" 
                       class="w-full h-2 bg-blue-200 rounded cursor-pointer" />
                <p class="text-lg font-semibold text-blue-900 mt-2">
                    <span id="sliderValue">{{ $averageMovingTime }}</span> hrs
                </p>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-center space-x-4 mt-6">
                <button type="button" id="backToStep0" class="bg-gray-300 py-2 px-4 rounded-lg @if(session('strava_access_token')) hidden @endif">Back</button>
                <button type="button" id="nextToStep2" class="bg-blue-600 text-white font-semibold px-4 py-2 rounded-md hover:bg-blue-700">Next</button>
            </div>
        </div>
    </div>
       


        <!-- Step 2: Cycling Brand Selection -->
        <div id="step2" class="wizard-step p-6 bg-white rounded-lg text-center hidden">
            <h2 class="text-2xl font-bold text-gray-900">🚴‍♂️ Choose Your Discount Brand!</h2>
            <p class="text-gray-400 mb-10">Select one of the leading cycling brands for your special discount.</p>
            
            <!-- Brand Options as Tiles -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Brand 1 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-4 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="brand" value="brand1" class="hidden" onclick="updateSelected(this, 'brand')">
                    <img src="https://logowik.com/content/uploads/images/specialized2163.jpg" alt="Brand 1" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Specialized</p>
                        <p class="text-gray-600 text-sm">Innovative designs and technology.</p>
                    </div>
                    <div class="selected-border absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>

                <!-- Brand 2 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-4 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="brand" value="brand2" class="hidden" checked onclick="updateSelected(this, 'brand')">
                    <img src="https://www.kinderfahrradfinder.de/storage/app/media/OpenGraph/canyonlogosquare.png" alt="Brand 2" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Canyon</p>
                        <p class="text-gray-600 text-sm">Innovative designs and technology.</p>
                    </div>
                    <div class="selected-border absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>

                <!-- Brand 3 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-2 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="brand" value="brand3" class="hidden" onclick="updateSelected(this, 'brand')">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMbW8r6UVXMwqb32lA3W2jiLvyhtkovepKxQ&s" alt="Brand 3" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Rapha</p>
                        <p class="text-gray-600 text-sm">Rugged bikes for adventurous riders.</p>
                    </div>
                    <div class="selected-border absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>

                <!-- Brand 4 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-2 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="brand" value="brand4" class="hidden" onclick="updateSelected(this, 'brand')">
                    <img src="https://logowik.com/content/uploads/images/castelli3837.logowik.com.webp" alt="Brand 4" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Castelli</p>
                        <p class="text-gray-600 text-sm">Rugged bikes for adventurous riders.</p>
                    </div>
                    <div class="selected-border absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>
            </div>

            <div class="flex justify-center space-x-4 mt-6">
                <button type="button" id="backToStep1" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="button" id="nextToStep4" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Next</button>
            </div>
        </div>

        
        <!-- Step 3: Charity Selection -->
        <div id="step3" class="wizard-step p-6 bg-white rounded-lg text-center hidden">
            <div class="max-w-2xl mx-auto"> <!-- Centers content and restricts width -->
                <h2 class="text-2xl font-bold text-gray-900">What If You Fail? 🤔</h2>
                <p class="text-gray-400 mb-10">
                    If you fall short of your goal, your penalty funds will go to one of these deserving charities. Choose wisely – who would you want to support if your pedals slow down?
                </p>
            </div>

            <!-- Charity Options as Tiles -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 mx-auto">
                <!-- Charity 1 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-4 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="charity" value="charity1" class="hidden" onclick="updateSelected(this)">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8UlZ5FNZSUOb8Bd6WaQUMaJrf1XjA-icu7Q&s" alt="Charity 1" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Save the Forests</p>
                        <p class="text-gray-600 text-sm">Help preserve our planet’s green lungs!</p>
                    </div>
                    <div class="selected-border absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>

                <!-- Charity 2 (Default Selected) -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-4 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="charity" value="charity2" class="hidden" checked onclick="updateSelected(this)">
                    <img src="https://media.4-paws.org/6/8/9/3/689354d6694789b45569cd647a6009e240b4afe7/VIER%20PFOTEN_2016-09-18_081-1927x1333-1920x1328.jpg" alt="Charity 2" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Support Animal Shelters</p>
                        <p class="text-gray-600 text-sm">Give a little love to our furry friends!</p>
                    </div>
                    <div class="selected-border absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true"></div>
                </label>

                <!-- Charity 3 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-4 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="charity" value="charity3" class="hidden" onclick="updateSelected(this)">
                    <img src="https://www.worldvision.org.uk/media/2jcb4saf/afghanistan_water_2017_wv1133330.jpg" alt="Charity 3" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Clean Water Initiative</p>
                        <p class="text-gray-600 text-sm">Ensure clean water for those in need.</p>
                    </div>
                    <div class="selected-border absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>
            </div>

            <div class="flex justify-center space-x-4 mt-6">
                <button type="button" id="backToStep2old" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="button" id="nextToStep4old" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Next</button>
            </div>
        </div>


        <div id="step4" class="wizard-step p-6 bg-white rounded-lg text-center hidden">
            <h2 class="text-2xl font-bold text-gray-900">💖 Ready to Give? Enter Your Donation!</h2>
            <div class="mb-4">
                <input type="number" name="donation_amount" id="donation_amount" value="10" min="10" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Enter donation amount" required />
                <p class="text-gray-600 mt-1 font-medium">
                    💖 Ready to make a difference? Enter your donation amount (minimum <strong>10 CHF</strong>)! 
                    <br>
                    *Only if you don’t meet your challenge! Let's keep it fun and motivating!*
                </p>
            </div>
            <div class="flex justify-center space-x-4 mt-6">
                <button type="button" id="backToStep2" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="button" id="reviewGoal" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Review Goal</button>
            </div>
        </div>

        <div id="reviewStep" class="wizard-step hidden">
            <h2 class="text-2xl font-bold text-gray-900">🎉 Review Your Goal! 🎉</h2>
            <p class="text-gray-500 mb-10">Step 4: Here are your exciting goal details:</p>
            <p><strong>Target Hours:</strong> <span id="reviewHours"></span></p>
            <p><strong>Selected Charity:</strong> <span id="reviewCharity"></span></p>
            <p><strong>Donation Amount:</strong> <span id="reviewPenalty"></span></p>
            <p class="mt-2 text-sm text-gray-500">*You’re making a difference! Your donation helps support a great cause!* 💖</p>
            <p class="font-semibold text-gray-800 mt-2">🛍️ Exclusive Offer from <strong>Your Favorite Brand</strong>: Enjoy a special discount when you complete your goal!</p>
            <div class="flex justify-center space-x-4 mt-6">
                <button type="button" id="backToStep3" class="bg-gray-300 py-2 px-4 rounded-lg hover:bg-gray-400">Back</button>
                <button type="submit" id="submitGoal" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Confirm My Goal!</button>
            </div>
        </div>
    </div>

    <form action="{{ route('goals.store') }}" method="POST" id="goalForm" class="hidden">
        @csrf
        <input type="hidden" name="target_hours" id="finalTargetHours">
        <input type="hidden" name="charity" id="finalCharity">
    </form>

    <script>
        const averageMovingTime = {{ $averageMovingTime }}; // This value should be passed from your backend
        const targetHoursInput = document.getElementById('target_hours');
        const sliderValueDisplay = document.getElementById('sliderValue');
        const discountMessage = document.getElementById('discountMessage');
        const discountContainer = document.getElementById('discountContainer');

        // Function to update the discount message based on the target hours
        function updateDiscountMessage() {
            const targetHours = parseFloat(targetHoursInput.value);
            sliderValueDisplay.textContent = targetHours.toFixed(1);

            // Calculate discount percentage
            const percentageIncrease = ((targetHours - averageMovingTime) / averageMovingTime) * 100;

            // Use the average moving time and target hours in the discount calculation
            const result = calculateDiscount(averageMovingTime, targetHours);
            
            discountContainer.classList.remove('hidden');

            discountMessage.innerHTML = 
                targetHours > averageMovingTime 
                ? `Great job! Hit your target to snag a <strong class="text-blue-900">${result.discount}</strong> discount on your favorite cycling brand! 🚴‍♂️`
                : '<span class="text-red-600">Increase your target to unlock an exciting discount!</span>';

        }

        // Initial call to display the discount message on load
        updateDiscountMessage();

        // Update discount message on slider input
        targetHoursInput.addEventListener('input', updateDiscountMessage);

        // Update discount message on slider input
        targetHoursInput.addEventListener('input', updateDiscountMessage);

        const sliderValue = document.getElementById('sliderValue');
        const nextToStep2 = document.getElementById('nextToStep2');
        const nextToStep4 = document.getElementById('nextToStep4');
        const reviewGoal = document.getElementById('reviewGoal');
        const submitGoal = document.getElementById('submitGoal');
        const backToStep0 = document.getElementById('backToStep0');
        const backToStep1 = document.getElementById('backToStep1');
        const backToStep2 = document.getElementById('backToStep2');
        const backToStep3 = document.getElementById('backToStep3');

        const introStep = document.getElementById('introStep');
        const wizard = document.getElementById('wizard');
        const steps = document.querySelectorAll('.wizard-step');

        function showStep(index) {
            index--;
            steps.forEach((step, i) => {
                step.classList.toggle('hidden', i !== index);
                step.classList.toggle('active', i === index);
            });
        }

        // Update displayed value on input change
        targetHoursInput.addEventListener('input', function() {
            sliderValue.innerHTML = this.value;
        });

        nextToStep2.addEventListener('click', function() {

            // Check if the donation amount is 0 or not
            if (sliderValueDisplay.textContent <= 0) {
                alert('Please enter a valid donation amount greater than 0!');
                return; // Stop further execution
            }

            // Proceed to the next step if the donation amount is valid
            showStep(3); // Show the second step
        });

        backToStep0.addEventListener('click', function() {
            showStep(0); // Show the first step in the wizard
        });

        backToStep1.addEventListener('click', function() {
            showStep(1); // Show the first step in the wizard
        });

        backToStep2.addEventListener('click', function() {
            showStep(2); // Show the second step again
        });

        nextToStep4.addEventListener('click', function() {
            showStep(4); // Show the third step
        });


        reviewGoal.addEventListener('click', function() {
            // Get the target hours from the input
            document.getElementById('reviewHours').innerText = targetHoursInput.value + ' hours';

            // Get the selected charity from the radio buttons
            const selectedCharity = document.querySelector('input[name="charity"]:checked');
            
            // Check if a charity is selected and retrieve the charity name
            document.getElementById('reviewCharity').innerText = selectedCharity ? 
                selectedCharity.closest('label').querySelector('.p-2 > p.font-semibold').innerText : 'None';

            // Get the donation amount
            document.getElementById('reviewPenalty').innerText = document.getElementById('donation_amount').value + ' CHF';

            // Show the review step
            showStep(4); 
        });

        backToStep3.addEventListener('click', function() {
            showStep(3); // Go back to the third step
        });

        submitGoal.addEventListener('click', function() {
            document.getElementById('finalTargetHours').value = targetHoursInput.value;
            document.getElementById('finalCharity').value = document.getElementById('charity').value;
            document.getElementById('goalForm').submit(); // Submit the form
        });

        function calculateDiscount(averageHours, targetHours) {
            let discountPercentage = 0;
            let multiplier = 1;

            // Determine rider level and set appropriate multiplier and max cap
            let level = '';
            let maxCap = 0;

            if (averageHours <= 4) {
                level = 'beginner';
                multiplier = 1.5; // Beginner gets a higher multiplier for incentive
                maxCap = 8;
            } else if (averageHours <= 10) {
                level = 'intermediate';
                multiplier = 1.2; // Intermediate gets moderate multiplier
                maxCap = 15;
            } else {
                level = 'advanced';
                multiplier = 1.0; // Advanced gets a standard multiplier
                maxCap = 20;
            }

            // Calculate the percentage increase from average to target
            const percentageIncrease = ((targetHours - averageHours) / averageHours) * 100;

            // Adjust the discount based on level, multiplier, and cap
            if (percentageIncrease > 0) {
                if (targetHours > maxCap) {
                    discountPercentage = (maxCap - averageHours) / averageHours * 100 * multiplier;
                    discountPercentage += 10; // Extra bonus for going beyond the max cap
                } else {
                    discountPercentage = percentageIncrease * multiplier;
                }
            }

            // Cap discount at 50%
            discountPercentage = Math.min(discountPercentage, 50);

            // Return the final discount and the rider's level for display
            return {
                discount: discountPercentage.toFixed(0) + '%',
                riderLevel: level,
                diff: targetHours - averageHours
            };
        }

        function updateSelected(selected, type) {
            // Hide blue border for all options in the specified group
            document.querySelectorAll(`input[name="${type}"]`).forEach(input => {
                const label = input.closest('label');
                if (label) { // Check if label exists
                    label.querySelector('.selected-border').style.display = 'none';
                }
            });

            // Show blue border on the currently selected option
            const selectedLabel = selected.closest('label');
            if (selectedLabel) { // Check if selectedLabel exists
                selectedLabel.querySelector('.selected-border').style.display = 'block';
            }
        }

        // Run once to set initial checked state on page load
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[name="brand"]').forEach(input => {
                if (input.checked) {
                    updateSelected(input, 'brand');
                }
            });
        });

    </script>
</div>
@endsection