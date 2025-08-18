<!-- Enrollment Modal -->
<div id="enrollment-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden opacity-0 transition-opacity duration-300 ease-in-out">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div id="enrollment-modal-content" class="bg-white rounded-xl shadow-2xl w-full max-w-2xl transform scale-95 opacity-0 transition-all duration-300 ease-in-out max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-primary to-orange-500 p-6 rounded-t-xl relative">
                <button id="close-enrollment-modal" class="absolute top-4 right-4 text-white hover:text-gray-200 focus:outline-none transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
                <div class="flex items-center">
                    <div class="mr-4">
                        <i class="fas fa-graduation-cap text-3xl text-white"></i>
                    </div>
                    <div>
                        <h3 id="modal-challenge-title" class="text-2xl font-bold text-white">Challenge Enrollment</h3>
                        <p class="text-white/90 mt-1">Join thousands of learners transforming their careers</p>
                    </div>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <!-- Challenge Details Section -->
                <div id="challenge-details" class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-bold text-lg mb-3 flex items-center">
                        <i class="fas fa-info-circle text-primary mr-2"></i>
                        Challenge Details
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-primary mr-2"></i>
                            <span><strong>Start Date:</strong> <span id="modal-start-date">-</span></span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-primary mr-2"></i>
                            <span><strong>Duration:</strong> 30 Days</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-tasks text-primary mr-2"></i>
                            <span><strong>Tasks:</strong> <span id="modal-task-count">-</span> Activities</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-rupee-sign text-primary mr-2"></i>
                            <span><strong>Price:</strong> <span id="modal-price">-</span></span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p id="modal-description" class="text-gray-700 text-sm"></p>
                    </div>
                </div>

                <!-- Enrollment Form -->
                <form id="enrollment-form" class="space-y-4">
                    <input type="hidden" id="challenge-id" name="challenge_id">
                    <input type="hidden" id="batch-id" name="batch_id">
                    
                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="enroll-name" class="block text-gray-700 text-sm font-medium mb-2">Full Name *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" id="enroll-name" name="name" required 
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    placeholder="Your full name">
                            </div>
                        </div>
                        
                        <div>
                            <label for="enroll-email" class="block text-gray-700 text-sm font-medium mb-2">Email Address *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" id="enroll-email" name="email" required 
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    placeholder="your@email.com">
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="enroll-phone" class="block text-gray-700 text-sm font-medium mb-2">Phone Number *</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input type="tel" id="enroll-phone" name="phone" required 
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    placeholder="+91 9876543210">
                            </div>
                        </div>
                        
                        <div>
                            <label for="enroll-age" class="block text-gray-700 text-sm font-medium mb-2">Age</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-birthday-cake text-gray-400"></i>
                                </div>
                                <input type="number" id="enroll-age" name="age" min="10" max="100"
                                    class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                                    placeholder="Your age">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Educational Background -->
                    <div>
                        <label for="enroll-education" class="block text-gray-700 text-sm font-medium mb-2">Current Education Level</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-graduation-cap text-gray-400"></i>
                            </div>
                            <select id="enroll-education" name="education" 
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent appearance-none">
                                <option value="">Select your education level</option>
                                <option value="Class VI">Class VI</option>
                                <option value="Class VII">Class VII</option>
                                <option value="Class VIII">Class VIII</option>
                                <option value="Class IX">Class IX</option>
                                <option value="Class X">Class X</option>
                                <option value="Class XI">Class XI</option>
                                <option value="Class XII">Class XII</option>
                                <option value="Undergraduate">Undergraduate</option>
                                <option value="Postgraduate">Postgraduate</option>
                                <option value="Professional">Working Professional</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Goals and Expectations -->
                    <div>
                        <label for="enroll-goals" class="block text-gray-700 text-sm font-medium mb-2">What do you hope to achieve? (Optional)</label>
                        <textarea id="enroll-goals" name="goals" rows="3" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" 
                            placeholder="Tell us about your goals and what you hope to gain from this challenge..."></textarea>
                    </div>
                    
                    <!-- Terms and Conditions -->
                    <div class="flex items-start">
                        <input type="checkbox" id="terms-checkbox" name="terms" required 
                            class="mt-1 h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="terms-checkbox" class="ml-2 text-sm text-gray-700">
                            I agree to the <a href="#" class="text-primary hover:underline">Terms and Conditions</a> and 
                            <a href="#" class="text-primary hover:underline">Privacy Policy</a>
                        </label>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" id="enrollment-submit-btn" 
                            class="w-full bg-primary hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-lg shadow-lg transition-all transform hover:-translate-y-1 border border-primary/50 hover:border-primary disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-paper-plane mr-2"></i> 
                            <span id="submit-text">Complete Enrollment</span>
                            <i id="loading-spinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                        </button>
                    </div>
                </form>
                
                <!-- Success Message -->
                <div id="enrollment-success" class="hidden mt-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3 text-xl"></i>
                        <div>
                            <h4 class="font-bold">Enrollment Successful!</h4>
                            <p class="text-sm mt-1">Thank you for enrolling! We'll contact you shortly with next steps and payment details.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Error Message -->
                <div id="enrollment-error" class="hidden mt-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 mr-3 text-xl"></i>
                        <div>
                            <h4 class="font-bold">Enrollment Failed</h4>
                            <p class="text-sm mt-1" id="error-message">Something went wrong. Please try again.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
