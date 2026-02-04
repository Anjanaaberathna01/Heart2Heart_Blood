<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Request - Heart2Heart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', Arial, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #e10600;
            font-size: 28px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .info-box {
            background: #f0f7ff;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 6px;
        }

        .info-box p {
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: 'Poppins', Arial, sans-serif;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #e10600;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #b80500;
        }

        .btn-secondary {
            background-color: #667eea;
        }

        .btn-secondary:hover {
            background-color: #5568d3;
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .button-group .btn {
            flex: 1;
            margin-top: 0;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: none;
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px;
            }

            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1><i class="fas fa-tint"></i> Donation Request</h1>
        <p>Request blood donation from our network of hospitals</p>
    </div>

    <div class="success-message" id="successMessage" style="display: {{ session('success') ? 'block' : 'none' }};">
        <strong>Success!</strong> {{ session('success') ?? "Your donation request has been submitted successfully. We'll notify you soon." }}
    </div>

    <div class="info-box">
        <p><strong>Information:</strong> Please fill in your details and blood type. Our partner hospitals will review your request and contact you as soon as compatible blood is available.</p>
    </div>

    <form id="donationForm" method="POST" action="{{ route('donate.request.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Full Name <span style="color: #e10600;">*</span></label>
            <input type="text" id="name" name="name" required placeholder="Enter your full name" value="{{ auth()-> user()->name ?? '' }}">
        </div>

        <div class="form-group">
            <label for="email">Email Address <span style="color: #e10600;">*</span></label>
            <input type="email" id="email" name="email" required placeholder="Enter your email" value="{{ auth()-> user()->email ?? '' }}">
        </div>

        <div class="form-group">
            <label for="phone">Phone Number <span style="color: #e10600;">*</span></label>
            <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number" value="{{ auth()-> user()->phone ?? '' }}">
        </div>

        <div class="form-group">
            <label for="blood_type">Blood Type Required <span style="color: #e10600;">*</span></label>
            <select id="blood_type" name="blood_type" required>
                        <div class="form-group">
                            <label for="units">Number of Units Required <span style="color: #e10600;">*</span></label>
                            <input type="number" id="units" name="units" required placeholder="Enter number of units" min="1" value="1">
                        </div>

                <option value="">Select Blood Type</option>
                <option value="O+">O+ (O Positive)</option>
                <option value="O-">O- (O Negative)</option>
                <option value="A+">A+ (A Positive)</option>
                <option value="A-">A- (A Negative)</option>
                <option value="B+">B+ (B Positive)</option>
                <option value="B-">B- (B Negative)</option>
                <option value="AB+">AB+ (AB Positive)</option>
                <option value="AB-">AB- (AB Negative)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="district">Location (District) <span style="color: #e10600;">*</span></label>
            <select id="district" name="district" required onchange="loadHospitals()">
                <option value="">Select District</option>
                <option value="Colombo">Colombo</option>
                <option value="Galle">Galle</option>
                <option value="Kandy">Kandy</option>
                <option value="Matara">Matara</option>
                <option value="Negombo">Negombo</option>
                <option value="Jaffna">Jaffna</option>
                <option value="Trincomalee">Trincomalee</option>
                <option value="Batticaloa">Batticaloa</option>
                <option value="Vavuniya">Vavuniya</option>
                <option value="Mullativu">Mullativu</option>
                <option value="Kurunegala">Kurunegala</option>
                <option value="Puttalam">Puttalam</option>
                <option value="Anuradhapura">Anuradhapura</option>
                <option value="Polonnaruwa">Polonnaruwa</option>
                <option value="Gampaha">Gampaha</option>
                <option value="Kalutara">Kalutara</option>
                <option value="Ratnapura">Ratnapura</option>
                <option value="Kegalle">Kegalle</option>
            </select>
        </div>
        <div class="form-group">
            <label for="hospital_id">Preferred Hospital <span style="color: #e10600;">*</span></label>
            <select id="hospital_id" name="hospital_id" required>
                <option value="">Select Hospital</option>
            </select>
        </div>

        <div class="form-group">
            <label for="reason">Medical Reason / Additional Notes</label>
            <textarea id="reason" name="reason" placeholder="Please provide details about why you need blood donation..."></textarea>
        </div>

        <div class="button-group">
            <button type="submit" class="btn">Submit Request</button>
            <button type="reset" class="btn btn-secondary">Clear Form</button>
        </div>
    </form>
</div>

<script>
    // Fetch ALL hospitals from database and organize by district
    const allHospitals = {!! json_encode(
        \App\Models\Hospital::select('id', 'user_name', 'mobile_number1', 'email', 'address', 'district', 'available_for_donation')
            ->orderBy('district')
            ->get()
            ->toArray()
    ) !!};

    // Create district grouped object
    const hospitalsByDistrict = {};
    allHospitals.forEach(hospital => {
        const dist = hospital.district.trim();
        if (!hospitalsByDistrict[dist]) {
            hospitalsByDistrict[dist] = [];
        }
        hospitalsByDistrict[dist].push({
            id: hospital.id,
            name: hospital.user_name,
            phone: hospital.mobile_number1,
            email: hospital.email,
            address: hospital.address,
            available: hospital.available_for_donation
        });
    });

    // Debug: Log all available districts
    console.log('Total Hospitals:', allHospitals.length);
    console.log('Districts Found:', Object.keys(hospitalsByDistrict));
    for (const [district, hospitals] of Object.entries(hospitalsByDistrict)) {
        console.log(`${district}: ${hospitals.length} hospital(s)`);
        hospitals.forEach(h => console.log(`  - ${h.name} (${h.phone}) ${h.available ? '✓ Available' : '✗ Unavailable'}`));
    }

    function loadHospitals() {
        const district = document.getElementById('district').value;
        const hospitalSelect = document.getElementById('hospital_id');
        hospitalSelect.innerHTML = '<option value="">Select Hospital</option>';

        console.log('Selected District:', district);

        if (district && hospitalsByDistrict[district]) {
            const hospitals = hospitalsByDistrict[district];
            console.log(`Loading ${hospitals.length} hospital(s) for ${district}`);

            hospitals.forEach(hospital => {
                const option = document.createElement('option');
                option.value = hospital.id;
                const status = hospital.available ? ' ✓ Available' : ' ✗ Unavailable';
                option.textContent = `${hospital.name} (${hospital.phone})${status}`;
                hospitalSelect.appendChild(option);
            });
        } else if (district) {
            console.warn(`No hospitals found for: ${district}`);
            hospitalSelect.innerHTML = '<option value="">No hospitals in this district</option>';
        }
    }

    // Form will submit to server endpoint
</script>

</body>
</html>
