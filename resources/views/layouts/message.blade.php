@if(isset($messageType))
    <style>
        @keyframes slideLeft {
            from {
                right: -50%;
            }
            to {
                right: 2rem;
            }
        }
        #notification-message {
            animation: slideLeft 300ms ease;
        }
    </style>
    <div class="fixed top-4 z-10 shadow-md border-2 bg-white p-4 max-w-md animate-slideLeft" id="notification-message">
        <x-dynamic-component :component="$messageType">
            <x-slot name="closeButton">
                <span class="absolute right-0 text-gray-600 cursor-pointer" onclick="closeMessage()">
                    <x-heroicon-o-x class="w-5" />
                </span>
            </x-slot>
            <p class="text-lg">{{ $messageText }}</p>
        </x-dynamic-component>
    </div>
    <script>
        function closeMessage() {
            document.getElementById('notification-message').style.display = 'none';
        }
        setTimeout(closeMessage, 5000);
    </script>
@endif
