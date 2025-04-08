<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickKart - Contact Us</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <!-- header section  -->
    <?php
    include 'theme-parts/header.php';
    ?>

    <section class="contact-section py-5">
        <div class="container">
            <h2 class="text-center mb-5">Contact Us</h2>
            <div class="row">
                <!-- Contact Information (Left Side) -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="contact-info-card">
                        <h3 class="mb-4">Contact Information</h3>

                        <div class="contact-details mb-4">
                            <h4>Contact Details</h4>
                            <div class="contact-item">
                                <i class="bi bi-telephone-fill"></i>
                                <span>+123 456 7890</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope-fill"></i>
                                <span>support@quickkart.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>123, QuickKart Plaza, City, Country</span>
                            </div>
                        </div>

                        <div class="business-hours mb-4">
                            <h4>Business Hours</h4>
                            <div class="hour-item">
                                <i class="bi bi-clock-fill"></i>
                                <span><strong>Monday - Friday:</strong> 9 AM - 8 PM</span>
                            </div>
                            <div class="hour-item">
                                <i class="bi bi-clock-fill"></i>
                                <span><strong>Saturday - Sunday:</strong> 10 AM - 6 PM</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form (Right Side) -->
                <div class="col-lg-7">
                    <div class="contact-form-card">
                        <h3 class="mb-4">Send Us a Message</h3>
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <select class="form-select" id="subject" required>
                                    <option value="" selected disabled>Select a subject</option>
                                    <option value="Order Issue">Order Issue</option>
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Feedback">Feedback</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Your Message" required></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn submit-btn">Send Message</button>
                            </div>
                        </form>

                        <!-- Success Message (Hidden by default) -->
                        <div class="alert alert-success mt-3 success-message" role="alert" style="display: none;">
                            Your message has been sent successfully! We'll get back to you soon.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optional Google Maps Integration -->
            <div class="map-container mt-5">
                <h3 class="text-center mb-4">Find Us</h3>
                <div class="map-wrapper">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00369368400567!3d40.71312937933185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s123%20Street%2C%20New%20York%2C%20NY%2010001!5e0!3m2!1sen!2sus!4v1647789052297!5m2!1sen!2sus"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <?php
    include 'theme-parts/footer.php';
    ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Simple form submission handling
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically add AJAX to submit the form data

            // Show success message
            document.querySelector('.success-message').style.display = 'block';

            // Reset form
            this.reset();

            // Hide success message after 5 seconds
            setTimeout(function() {
                document.querySelector('.success-message').style.display = 'none';
            }, 5000);
        });
    </script>
</body>

</html>