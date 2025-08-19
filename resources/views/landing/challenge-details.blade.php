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

    <div class="container mx-auto px-6 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Challenge Header -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="relative h-64 bg-gradient-to-r from-primary to-orange-500">
                    @if($challenge->thumbnail_image)
                        <img src="{{ asset($challenge->thumbnail_image) }}" 
                             alt="{{ $challenge->title }}" 
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                    @endif
                    
                    <div class="absolute inset-0 flex items-center justify-center text-center text-white p-6">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $challenge->title }}</h1>
                            <p class="text-xl opacity-90">{{ $challenge->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Challenge Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Challenge Information -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i class="fas fa-info-circle text-primary mr-3"></i>
                            Challenge Details
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-tasks text-primary text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Total Tasks</h3>
                                    <p class="text-gray-600">{{ $challenge->number_of_tasks }} engaging activities</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-clock text-primary text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Duration</h3>
                                    <p class="text-gray-600">30 days program</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-rupee-sign text-primary text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Price</h3>
                                    <p class="text-gray-600">
                                        @if($challenge->special_price)
                                            <span class="line-through text-gray-400">₹{{ number_format($challenge->selling_price, 0) }}</span>
                                            <span class="text-green-600 font-bold ml-2">₹{{ number_format($challenge->special_price, 0) }}</span>
                                        @else
                                            ₹{{ number_format($challenge->selling_price, 0) }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                    <i class="fas fa-users text-primary text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Format</h3>
                                    <p class="text-gray-600">Online guided program</p>
                                </div>
                            </div>
                        </div>

                        @if($challenge->features)
                            <div class="mb-6">
                                <h3 class="text-xl font-bold mb-4">Key Features</h3>
                                <div class="prose max-w-none text-gray-700">
                                    {!! nl2br(e($challenge->features)) !!}
                                </div>
                            </div>
                        @endif

                        @if($challenge->who_is_this_for)
                            <div>
                                <h3 class="text-xl font-bold mb-4">Who Is This For?</h3>
                                <div class="prose max-w-none text-gray-700">
                                    {!! nl2br(e($challenge->who_is_this_for)) !!}
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Available Batches -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i class="fas fa-calendar text-primary mr-3"></i>
                            Available Batches
                        </h2>
                        
                        @if($challenge->batches->count() > 0)
                            <div class="space-y-4">
                                @foreach($challenge->batches as $batch)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:border-primary transition-colors">
                                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                                            <div class="mb-4 md:mb-0">
                                                <h3 class="font-bold text-lg">{{ $batch->title }}</h3>
                                                @if($batch->description)
                                                    <p class="text-gray-600 mt-1">{{ $batch->description }}</p>
                                                @endif
                                                <div class="flex items-center mt-2 text-sm text-gray-500">
                                                    <i class="fas fa-calendar-alt mr-2"></i>
                                                    <span>Starts: {{ \Carbon\Carbon::parse($batch->start_date)->format('F d, Y') }}</span>
                                                    <i class="fas fa-clock ml-4 mr-2"></i>
                                                    <span>Time: {{ \Carbon\Carbon::parse($batch->time)->format('h:i A') }}</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                                    {{ ucfirst($batch->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-calendar-times text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600">No batches available at the moment.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Enrollment Form -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                        <h2 class="text-2xl font-bold mb-6 flex items-center">
                            <i class="fas fa-user-plus text-primary mr-3"></i>
                            Enroll Now
                        </h2>

                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                    <div>
                                        <h4 class="font-bold">Enrollment Successful!</h4>
                                        <p class="text-sm mt-1">{{ session('success') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
                                <div class="flex items-center">
                                    <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                                    <div>
                                        <h4 class="font-bold">Enrollment Failed</h4>
                                        <p class="text-sm mt-1">{{ session('error') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('enrollment.pay') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="challenge_id" value="{{ $challenge->id }}">
                            <input type="hidden" name="amount" value="{{ $challenge->special_price ?? $challenge->selling_price }}">
                            
                            @if($challenge->batches->count() > 0)
                                <div>
                                    <label for="batch_id" class="block text-gray-700 text-sm font-medium mb-2">Select Batch *</label>
                                    <select name="batch_id" id="batch_id" required 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                        <option value="">Choose a batch</option>
                                        @foreach($challenge->batches as $batch)
                                            <option value="{{ $batch->id }}">
                                                {{ $batch->title }} - {{ \Carbon\Carbon::parse($batch->start_date)->format('M d, Y') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('batch_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif
                            
                            <div>
                                <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Full Name *</label>
                                <input type="text" name="name" id="name" required value="{{ old('name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    placeholder="Your full name">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email Address *</label>
                                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    placeholder="your@email.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-gray-700 text-sm font-medium mb-2">Phone Number *</label>
                                <input type="tel" name="phone" id="phone" required value="{{ old('phone') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    placeholder="+91 9876543210">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="date_of_birth" class="block text-gray-700 text-sm font-medium mb-2">Date of Birth *</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" required value="{{ old('date_of_birth') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                @error('date_of_birth')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="gender" class="block text-gray-700 text-sm font-medium mb-2">Gender *</label>
                                <select name="gender" id="gender" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Select your gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="prefer_not_to_say" {{ old('gender') == 'prefer_not_to_say' ? 'selected' : '' }}>Prefer not to say</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="education" class="block text-gray-700 text-sm font-medium mb-2">Education Level</label>
                                <select name="education" id="education" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                                    <option value="">Select your education level</option>
                                    <option value="Class VI" {{ old('education') == 'Class VI' ? 'selected' : '' }}>Class VI</option>
                                    <option value="Class VII" {{ old('education') == 'Class VII' ? 'selected' : '' }}>Class VII</option>
                                    <option value="Class VIII" {{ old('education') == 'Class VIII' ? 'selected' : '' }}>Class VIII</option>
                                    <option value="Class IX" {{ old('education') == 'Class IX' ? 'selected' : '' }}>Class IX</option>
                                    <option value="Class X" {{ old('education') == 'Class X' ? 'selected' : '' }}>Class X</option>
                                    <option value="Class XI" {{ old('education') == 'Class XI' ? 'selected' : '' }}>Class XI</option>
                                    <option value="Class XII" {{ old('education') == 'Class XII' ? 'selected' : '' }}>Class XII</option>
                                    <option value="Undergraduate" {{ old('education') == 'Undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                                    <option value="Postgraduate" {{ old('education') == 'Postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                                    <option value="Professional" {{ old('education') == 'Professional' ? 'selected' : '' }}>Working Professional</option>
                                </select>
                                @error('education')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="goals" class="block text-gray-700 text-sm font-medium mb-2">Goals (Optional)</label>
                                <textarea name="goals" id="goals" rows="3" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    placeholder="What do you hope to achieve?">{{ old('goals') }}</textarea>
                                @error('goals')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex items-start">
                                <input type="checkbox" name="terms" id="terms" required 
                                    class="mt-1 h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="terms" class="ml-2 text-sm text-gray-700">
                                    I agree to the Terms and Conditions and Privacy Policy *
                                </label>
                                @error('terms')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <button type="submit" 
                                class="w-full bg-primary hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1">
                                <i class="fas fa-paper-plane mr-2"></i> Complete Enrollment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('landing.partials.footer')
