@include('landing.partials.header')

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/irisepro-logo.png') }}" alt="iRisePro Logo" class="h-12">
                </a>
                <a href="/" class="text-primary hover:text-orange-600 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Home
                </a>
            </div>
        </div>
    </header>

    <!-- Page Title Section -->
    <section class="bg-gradient-to-r from-primary to-orange-500 py-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Available Challenges
            </h1>
            <p class="text-xl text-white opacity-90 max-w-3xl mx-auto">
                Discover our comprehensive range of personal development challenges designed to unlock your potential and accelerate your growth journey.
            </p>
        </div>
    </section>

    <!-- Challenges Grid -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            @if($challenges->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($challenges as $challenge)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <!-- Challenge Image -->
                            <div class="relative h-48 bg-gradient-to-r from-primary to-orange-500">
                                @if($challenge->thumbnail_image)
                                    <img src="{{ asset($challenge->thumbnail_image) }}" 
                                         alt="{{ $challenge->title }}" 
                                         class="absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
                                @endif
                                
                                <!-- Challenge Badge -->
                                <div class="absolute top-4 right-4">
                                    <span class="bg-white text-primary px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $challenge->number_of_tasks }} Tasks
                                    </span>
                                </div>
                                
                                <!-- Price Badge -->
                                <div class="absolute bottom-4 left-4">
                                    <div class="bg-white rounded-lg px-3 py-2">
                                        @if($challenge->special_price)
                                            <span class="text-gray-400 line-through text-sm">₹{{ number_format($challenge->selling_price, 0) }}</span>
                                            <span class="text-primary font-bold text-lg ml-2">₹{{ number_format($challenge->special_price, 0) }}</span>
                                        @else
                                            <span class="text-primary font-bold text-lg">₹{{ number_format($challenge->selling_price, 0) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Challenge Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $challenge->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $challenge->description }}</p>
                                
                                <!-- Challenge Features -->
                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        <span>30 Days</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-users mr-1"></i>
                                        <span>{{ $challenge->batches->count() }} Batches</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-star mr-1 text-yellow-400"></i>
                                        <span>Premium</span>
                                    </div>
                                </div>

                                <!-- Available Batches -->
                                @if($challenge->batches->count() > 0)
                                    <div class="mb-4">
                                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Available Batches:</h4>
                                        <div class="space-y-2">
                                            @foreach($challenge->batches->take(2) as $batch)
                                                <div class="bg-gray-50 rounded-lg p-3">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <p class="font-medium text-sm text-gray-900">{{ $batch->title }}</p>
                                                            <p class="text-xs text-gray-600 mt-1">
                                                                <i class="fas fa-calendar mr-1"></i>
                                                                Starts: {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                                            </p>
                                                            <p class="text-xs text-gray-600">
                                                                <i class="fas fa-clock mr-1"></i>
                                                                Time: {{ \Carbon\Carbon::parse($batch->time)->format('h:i A') }}
                                                            </p>
                                                        </div>
                                                        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                                            {{ ucfirst($batch->status) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                            
                                            @if($challenge->batches->count() > 2)
                                                <p class="text-xs text-gray-500 text-center">
                                                    +{{ $challenge->batches->count() - 2 }} more batches available
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="mb-4 text-center py-3">
                                        <p class="text-sm text-gray-500">No batches available at the moment</p>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('challenge.details', $challenge->id) }}" 
                                       class="flex-1 bg-primary hover:bg-orange-600 text-white text-center py-3 px-4 rounded-lg font-medium transition-all duration-200 transform hover:-translate-y-1">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        View Details
                                    </a>
                                    @if($challenge->batches->count() > 0)
                                        <a href="{{ route('challenge.details', $challenge->id) }}" 
                                           class="flex-1 bg-green-500 hover:bg-green-600 text-white text-center py-3 px-4 rounded-lg font-medium transition-all duration-200 transform hover:-translate-y-1">
                                            <i class="fas fa-user-plus mr-2"></i>
                                            Enroll Now
                                        </a>
                                    @else
                                        <button class="flex-1 bg-gray-400 text-white text-center py-3 px-4 rounded-lg font-medium cursor-not-allowed" disabled>
                                            <i class="fas fa-clock mr-2"></i>
                                            Coming Soon
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Challenges Available -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-trophy text-6xl text-gray-300 mb-6"></i>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">No Challenges Available</h3>
                        <p class="text-gray-600 mb-8">
                            We're working on bringing you amazing challenges. Check back soon for exciting personal development opportunities!
                        </p>
                        <a href="/" class="bg-primary hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-medium transition duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Back to Home
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-gradient-to-r from-primary to-orange-500 py-16">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Ready to Transform Your Life?
            </h2>
            <p class="text-xl text-white opacity-90 mb-8 max-w-2xl mx-auto">
                Join thousands of individuals who have already started their journey of personal growth and success.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-white text-primary hover:bg-gray-100 px-8 py-3 rounded-lg font-semibold transition duration-200">
                    <i class="fas fa-phone mr-2"></i>
                    Contact Us
                </a>
                <a href="#" class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-lg font-semibold transition duration-200">
                    <i class="fas fa-question-circle mr-2"></i>
                    Learn More
                </a>
            </div>
        </div>
    </section>

@include('landing.partials.footer')
