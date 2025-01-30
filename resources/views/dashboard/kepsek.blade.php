<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <div class="w-full" style="overflow-wrap: break-word;">
            @php
            // echo $pendaftar;
            @endphp
        </div>
        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-8 p-4">
            <div class="w-full">
                <x-chartjs-component :chart="$PendaftarChart" />
            </div>

            <div class="w-full">
                <x-chartjs-component :chart="$uncompleteRegistrationChart" />
            </div>

            <div class="w-full">
                <x-chartjs-component :chart="$genderChart" />
            </div>

            <div class="w-full">
                <x-chartjs-component :chart="$previousSchoolChart" />
            </div>

            <div class="w-full">
                <x-chartjs-component :chart="$averageIncomeChart" />
            </div>
            <div class="w-full">
                <x-chartjs-component :chart="$kipChart" />
            </div>
            
        </div>

    </div>
</x-app-layout>