@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Set Your Cycling Goal</h2>

    <!-- Explanation Step -->
    <div id="introStep" class="wizard-step active">
        <h4 class="font-semibold mb-2">Welcome to Your Cycling Goal Wizard!</h4>
        <p class="text-lg mb-4">
            In this wizard, you'll set your cycling goal based on your average moving time.
            Follow the steps to establish your target hours, choose a charity, and set a penalty amount.
        </p>
        <p class="text-gray-600 mb-4">
            Make sure to choose a realistic target to maximize your success. Let's get started!
        </p>
        <button type="button" id="nextToStep1" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Start Setting Your Goal</button>
    </div>

    <!-- Goal Setting Steps -->
    <div id="wizard" class="mt-4 hidden">
        <div id="step1" class="wizard-step">
            <h4 class="font-semibold mb-2">Step 1: Target Hours per Week</h4>
            <div class="mb-4">
                <label for="target_hours" class="block text-sm font-medium text-gray-700">Target Hours per week</label>
                <input type="range" name="target_hours" id="target_hours" min="0" max="24" step="0.5" value="{{ $suggestedTimeGoal }}" class="mt-1 w-full h-2 bg-blue-200 rounded-lg appearance-none cursor-pointer" />
                <p class="text-center text-lg mt-2"><strong id="sliderValue">{{ $suggestedTimeGoal }}</strong> hours</p>
            </div>
            <div class="flex justify-between">
                <button type="button" id="nextToStep2" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Next</button>
            </div>
        </div>

        <div id="step2" class="wizard-step hidden">
            <h4 class="font-semibold mb-2">Step 2: Choose a Charity</h4>
            <div class="mb-4">
                <label for="charity" class="block text-sm font-medium text-gray-700">Choose a Charity</label>
                <select name="charity" id="charity" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    <option value="">Select a charity...</option>
                    <option value="charity1">Charity 1</option>
                    <option value="charity2">Charity 2</option>
                    <option value="charity3">Charity 3</option>
                </select>
                <p class="text-gray-600 mt-1">Your contribution will help those in need if you don’t meet your goal.</p>
            </div>
            <div class="flex justify-between">
                <button type="button" id="backToStep1" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="button" id="nextToStep3" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Next</button>
            </div>
        </div>

        <div id="step3" class="wizard-step hidden">
            <h4 class="font-semibold mb-2">Step 3: Enter Penalty Amount</h4>
            <div class="mb-4">
                <label for="penalty_amount" class="block text-sm font-medium text-gray-700">Penalty Amount (if you fail)</label>
                <input type="number" name="penalty_amount" id="penalty_amount" class="mt-1 block w-full border border-gray-300 rounded-md p-2" placeholder="Enter penalty amount" required />
                <p class="text-gray-600 mt-1">Enter the amount you are willing to donate to the charity.</p>
            </div>
            <div class="flex justify-between">
                <button type="button" id="backToStep2" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="button" id="reviewGoal" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Review Goal</button>
            </div>
        </div>

        <div id="reviewStep" class="wizard-step hidden">
            <h4 class="font-semibold mb-2">Review Your Goal</h4>
            <p>Your goal details:</p>
            <p><strong>Target Hours:</strong> <span id="reviewHours"></span></p>
            <p><strong>Charity:</strong> <span id="reviewCharity"></span></p>
            <p><strong>Penalty Amount:</strong> <span id="reviewPenalty"></span></p>
            <div class="flex justify-between mt-4">
                <button type="button" id="backToStep3" class="bg-gray-300 py-2 px-4 rounded-lg">Back</button>
                <button type="submit" id="submitGoal" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Confirm Goal</button>
            </div>
        </div>
    </div>

    <form action="{{ route('goals.store') }}" method="POST" id="goalForm" class="hidden">
        @csrf
        <input type="hidden" name="target_hours" id="finalTargetHours">
        <input type="hidden" name="charity" id="finalCharity">
        <input type="hidden" name="penalty_amount" id="finalPenaltyAmount">
    </form>

    <script>
        const targetHoursInput = document.getElementById('target_hours');
        const sliderValue = document.getElementById('sliderValue');
        const nextToStep1 = document.getElementById('nextToStep1');
        const nextToStep2 = document.getElementById('nextToStep2');
        const nextToStep3 = document.getElementById('nextToStep3');
        const reviewGoal = document.getElementById('reviewGoal');
        const submitGoal = document.getElementById('submitGoal');
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
            showStep(2); // Show the second step
        });

        backToStep1.addEventListener('click', function() {
            showStep(1); // Show the first step in the wizard
        });

        nextToStep3.addEventListener('click', function() {
            showStep(3); // Show the third step
        });

        backToStep2.addEventListener('click', function() {
            showStep(2); // Show the second step again
        });

        reviewGoal.addEventListener('click', function() {
            document.getElementById('reviewHours').innerText = targetHoursInput.value + ' hours';
            document.getElementById('reviewCharity').innerText = document.getElementById('charity').value || 'None';
            document.getElementById('reviewPenalty').innerText = document.getElementById('penalty_amount').value + ' CHF';
            showStep(4); // Show the review step
        });

        backToStep3.addEventListener('click', function() {
            showStep(3); // Go back to the third step
        });

        submitGoal.addEventListener('click', function() {
            document.getElementById('finalTargetHours').value = targetHoursInput.value;
            document.getElementById('finalCharity').value = document.getElementById('charity').value;
            document.getElementById('finalPenaltyAmount').value = document.getElementById('penalty_amount').value;
            document.getElementById('goalForm').submit(); // Submit the form
        });
    </script>
</div>
@endsection