<div style="height: 100vh;">
    <!-- Sidebar -->
    <div style="width: 250px; background-color: #D9D9D9; color: white; padding: 20px; display: flex; flex-direction: column; justify-content: flex-start;">
        <ul style="list-style-type: none; padding: 0;">
            <li style="margin-bottom: 10px; text-align: center;">
                <a 
                href="{{ route('dashboard') }}" 
                :class="{'bg-gray-200': request()->routeIs('dashboard')}" 
                style="display: block; padding: 15px; background-color: #FFFFFF; color: black; text-decoration: none; border-radius: 10px;">
                {{ __('Dashboard') }}
            </a>
            <li style="margin-bottom: 10px; text-align: center;">
                <a 
                href="{{ route('datin') }}" 
                :class="{'bg-gray-200': request()->routeIs('datin')}" 
                style="display: block; padding: 15px; background-color: #FFFFFF; color: black; text-decoration: none; border-radius: 10px;">
                {{ __('Datin') }}
            </a>
            </li>
            <li style="margin-bottom: 10px; text-align: center;">
                <a 
                href="{{ route('non-datin') }}" 
                :class="{'bg-gray-200': request()->routeIs('non-datin')}" 
                style="display: block; padding: 15px; background-color: #FFFFFF; color: black; text-decoration: none; border-radius: 10px;">
                {{ __('Non-Datin') }}
            </a>
            </li>
            <li style="margin-bottom: 10px; text-align: center;">
                <a 
                href="{{ route('account-manager') }}" 
                :class="{'bg-gray-200': request()->routeIs('account-manager')}" 
                style="display: block; padding: 15px; background-color: #FFFFFF; color: black; text-decoration: none; border-radius: 10px;">
                {{ __('Account Manager') }}
            </a>
            </li>
        </ul>
    </div>

<main>
    {{ $slot }}
</main>

</div>
