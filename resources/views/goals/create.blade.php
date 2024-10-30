@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">

    <!-- Intro Step -->
    <div id="introStep" class="wizard-step active p-4 bg-gray-50 rounded-lg border-2 border-gray-300">
        <h4 class="text-xl font-semibold mb-2">Welcome to Your Cycling Goal Wizard</h4>
        <p class="text-gray-600 mb-4">
            Set a target based on your weekly cycling average to stay motivated and earn rewards.
            Your current average is <strong class="text-gray-800">{{ $averageMovingTime }} hours/week</strong>.
        </p>
        <p class="text-green-600 font-semibold mb-4">
            Complete your goal to earn a discount based on your challenge level!
        </p>
        <button type="button" id="nextToStep1" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Get Started</button>
    </div>

    <!-- Goal Setting Wizard -->
    <div id="wizard" class="mt-4 hidden">
       <!-- Step 1: Set Target Hours -->
        <div id="step1" class="wizard-step">
            <h4 class="text-xl font-semibold mb-4">🔥 Set Your Weekly Goal!</h4>
            
            <!-- Current Average -->
            <p class="text-gray-600 mb-4">
                Your current average is <strong class="text-gray-800">{{ $averageMovingTime }} hours/week</strong>.
            </p>

            <!-- Target Hours Selection -->
            <div id="targetHoursContainer" class="p-3 rounded-lg border border-blue-400 bg-blue-50 mb-4">
                <p class="text-lg font-semibold text-blue-700">Set Your Target</p>
                <input type="range" name="target_hours" id="target_hours" min="0" max="24" step="1" 
                       value="0" 
                       class="w-full h-2 bg-blue-200 rounded-lg cursor-pointer mt-2" />
                <p class="text-center text-lg font-semibold mt-2">
                    <strong id="sliderValue" class="text-blue-900">0</strong> hours
                </p>
            </div>

            <!-- Discount Reward Display -->
            <div id="discountContainer" class="p-3 rounded-lg border border-green-500 bg-green-50 mb-4 hidden">
                <p id="discountMessage" class="text-xl text-green-800 my-2"></p>
            </div>

            <div class="flex justify-between mt-6">
                <button type="button" id="backToIntro" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="button" id="nextToStep2" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Next</button>
            </div>
        </div>
    </div>
       
       <!-- Step 2: Charity Selection -->
        <div id="step2" class="wizard-step hidden">
            <h4 class="text-xl font-semibold mb-2">What If You Fail? 🤔</h4>
            <p class="text-gray-600 mb-4">If you fall short of your goal, your penalty funds will go to one of these deserving charities. Choose wisely – who would you want to support if your pedals slow down?</p>

            <!-- Charity Options as Tiles -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <!-- Charity 1 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-4 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="charity" value="charity1" class="hidden">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8UlZ5FNZSUOb8Bd6WaQUMaJrf1XjA-icu7Q&s" alt="Charity 1" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Save the Forests</p>
                        <p class="text-gray-600 text-sm">Help preserve our planet’s green lungs!</p>
                    </div>
                    <div class="absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>

                <!-- Charity 2 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-4 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="charity" value="charity2" class="hidden" checked>
                    <img src="https://media.4-paws.org/6/8/9/3/689354d6694789b45569cd647a6009e240b4afe7/VIER%20PFOTEN_2016-09-18_081-1927x1333-1920x1328.jpg" alt="Charity 2" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Support Animal Shelters</p>
                        <p class="text-gray-600 text-sm">Give a little love to our furry friends!</p>
                    </div>
                    <div class="absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>

                <!-- Charity 3 -->
                <label class="block border rounded-lg overflow-hidden shadow-sm cursor-pointer transition-transform transform hover:scale-105 relative border-gray-300 ring-2 ring-transparent focus-within:ring-blue-500">
                    <input type="radio" name="charity" value="charity3" class="hidden">
                    <img src="https://www.worldvision.org.uk/media/2jcb4saf/afghanistan_water_2017_wv1133330.jpg" alt="Charity 3" class="w-full h-32 object-cover">
                    <div class="p-2 bg-gray-50 text-center">
                        <p class="font-semibold text-gray-800">Clean Water Initiative</p>
                        <p class="text-gray-600 text-sm">Ensure clean water for those in need.</p>
                    </div>
                    <div class="absolute inset-0 border-2 border-blue-500 rounded-lg pointer-events-none" aria-hidden="true" style="display: none;"></div>
                </label>
            </div>

            <div class="flex justify-between">
                <button type="button" id="backToStep1" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="button" id="nextToStep3" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Next</button>
            </div>
        </div>


        <div id="step3" class="wizard-step hidden">
            <h4 class="text-xl font-semibold mb-2">💖 Ready to Give? Enter Your Donation!</h4>
            <div class="mb-4">
                <input type="number" name="donation_amount" id="donation_amount" value="10" min="10" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Enter donation amount" required />
                <p class="text-gray-600 mt-1 font-medium">
                    💖 Ready to make a difference? Enter your donation amount (minimum <strong>10 CHF</strong>)! 
                    <br>
                    *Only if you don’t meet your challenge! Let's keep it fun and motivating!*
                </p>
            </div>
            <div class="flex justify-between">
                <button type="button" id="backToStep2" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="button" id="reviewGoal" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Review Goal</button>
            </div>
        </div>

        <div id="reviewStep" class="wizard-step hidden">
            <h4 class="font-semibold mb-2 text-xl text-blue-600">🎉 Review Your Goal! 🎉</h4>
            <p class="text-gray-700">Step 4: Here are your exciting goal details:</p>
            <p><strong>Target Hours:</strong> <span id="reviewHours"></span></p>
            <p><strong>Selected Charity:</strong> <span id="reviewCharity"></span></p>
            <p><strong>Donation Amount:</strong> <span id="reviewPenalty"></span></p>
            <p class="mt-2 text-sm text-gray-500">*You’re making a difference! Your donation helps support a great cause!* 💖</p>
            <p class="font-semibold text-gray-800 mt-2">🛍️ Exclusive Offer from <strong>Your Favorite Brand</strong>: Enjoy a special discount when you complete your goal!</p>
            <div class="flex justify-between mt-4">
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
        //updateDiscountMessage();

        // Update discount message on slider input
        targetHoursInput.addEventListener('input', updateDiscountMessage);

        // Update discount message on slider input
        targetHoursInput.addEventListener('input', updateDiscountMessage);

        const sliderValue = document.getElementById('sliderValue');
        const nextToStep1 = document.getElementById('nextToStep1');
        const nextToStep2 = document.getElementById('nextToStep2');
        const nextToStep3 = document.getElementById('nextToStep3');
        const reviewGoal = document.getElementById('reviewGoal');
        const submitGoal = document.getElementById('submitGoal');
        const backToIntro = document.getElementById('backToIntro');
        const backToStep1 = document.getElementById('backToStep1');
        const backToStep2 = document.getElementById('backToStep2');
        const backToStep3 = document.getElementById('backToStep3');

        const introStep = document.getElementById('introStep');
        const wizard = document.getElementById('wizard');
        const steps = document.querySelectorAll('.wizard-step');

        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle('hidden', i !== index);
                step.classList.toggle('active', i === index);
            });
        }

        // Update displayed value on input change
        targetHoursInput.addEventListener('input', function() {
            sliderValue.innerHTML = this.value;
        });

        // Step navigation
        nextToStep1.addEventListener('click', function() {
            introStep.classList.add('hidden'); // Hide the intro step
            wizard.classList.remove('hidden'); // Show the wizard steps
            showStep(1); // Show the first step in the wizard
        });

        nextToStep2.addEventListener('click', function() {
            // Check if the donation amount is 0 or not
            if (sliderValueDisplay.textContent <= 0) {
                alert('Please enter a valid donation amount greater than 0!');
                return; // Stop further execution
            }

            // Proceed to the next step if the donation amount is valid
            showStep(2); // Show the second step
        });

        backToStep1.addEventListener('click', function() {
            showStep(1); // Show the first step in the wizard
        });

        nextToStep3.addEventListener('click', function() {
            showStep(3); // Show the third step
        });


        backToIntro.addEventListener('click', function() {
            introStep.classList.remove('hidden'); // Hide the intro step
            wizard.classList.add('hidden'); // Show the wizard steps
        });

        backToStep2.addEventListener('click', function() {
            showStep(2); // Show the second step again
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



         // JavaScript to show the selection border for the checked input
        document.querySelectorAll('input[name="charity"]').forEach(input => {
            input.addEventListener('change', function() {
                document.querySelectorAll('label div[aria-hidden="true"]').forEach(div => {
                    div.style.display = 'none'; // Hide all borders
                });
                this.parentElement.querySelector('div[aria-hidden="true"]').style.display = 'block'; // Show selected border
            });

            if (input.checked) {
                input.dispatchEvent(new Event('change')); // Trigger change for default selection
            }
        });

    </script>
</div>
@endsection