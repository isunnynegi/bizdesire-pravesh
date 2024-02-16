<section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Invite Friends') }}
        </h2>
        <div class="flex items-center mt-4">
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Refer your friends to get cashback.") }}
        </p>
        <span class="mt-1 text-sm text-gray-600 dark:text-gray-400 justify-end">
            "{{ $user->referralLink() }}"
        </span>
    </header>
</section>