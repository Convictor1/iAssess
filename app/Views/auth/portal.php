<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>iAssess Portal | Iriga City Assessor’s Office</title>
    <!-- Bootstrap 5 (for modal + basic layout) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<div class="container py-5">

    <!-- Auth Buttons -->
    <div class="d-flex justify-content-end mb-4">
        <a href="<?= base_url('login') ?>" class="btn btn-outline-primary me-2">Login</a>
        <a href="<?= base_url('register') ?>" class="btn btn-primary">Sign Up</a>
    </div>

    <!-- NOTICE TO THE PUBLIC -->
    <div class="bg-white p-4 rounded shadow-sm mb-5">
        <h4 class="mb-3">NOTICE TO THE PUBLIC</h4>
        <p>
            Due to the influx in the number of clients transacting business with the Iriga City Assessor’s Office, strict physical distancing has become challenging. Thus, effective <strong>01 December 2025</strong>, we will implement a new schedule for document requests, to wit:
        </p>
        <ul>
            <li>Assessment Transactions: Accepting and releasing on a Tue–Thu schedule only.</li>
        </ul>
        <p>
            A TRANSACTION CODE will be sent via email with your appointment or release date. Walk-in clients not on schedule will not be entertained. We strongly advise that you send your requests online before visiting our office.
        </p>
        <p>Welcome!</p>
        <p>
            The Iriga City Assessor’s Office is innovating to serve you better. You can now submit requests through our Online Application Form. Please complete all fields to prevent processing delays.
        </p>
        <p><strong>CITY ASSESSOR’S OFFICE TRANSACTION REQUESTS<br>
        CITY OF IRIGA<br>(v 2.0)</strong></p>
    </div>

    <!-- Check Application by Transaction Code -->
    <div class="bg-white p-4 rounded shadow-sm mb-5">
        <h5 class="mb-3">Check Your Application</h5>
        <form id="codeForm" method="get" action="#" onsubmit="event.preventDefault();">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Enter transaction code" id="transactionCode" required>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#privacyModal">
                    Continue
                </button>
            </div>
        </form>
        <p>Any queries or concerns? Contact Us!</p>
        <p>
            <strong>IrigaCityAssessor<br>
            assessor@irigacity.gov.ph<br>
            insert telphone num here<br>
            Assessor’s Office, Ground Floor, Iriga City Hall, Real St., Iriga City, Camarines Sur</strong>
        </p>
        <p class="text-muted">2025 &copy; City Government of Iriga<br>Management Information Systems Office</p>
    </div>
</div>

<!-- Data Privacy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="privacyModalLabel">Data Privacy Notice</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h6>PERSONAL DATA COLLECTED</h6>
        <p>
          We at the Iriga City Assessor’s Office collect and process personal data—including name, address (home or office), contact information (landline, mobile no., email), and any other information relevant to your application or supporting documents.
        </p>
        <h6>PURPOSE AND DATA USAGE</h6>
        <p>
          All personal data collected will be used for: issuance of requested certifications; issuance of new or certified true copies of Tax Declarations; and only to the extent necessary for compliance with our legal obligations and to further the City Government’s legitimate interests.
        </p>
        <h6>STORAGE AND DISPOSAL</h6>
        <p>
          Data shall be stored in filing cabinets, vaults, databases, or off-site archives and disposed of per the National Archives of the Philippines and related issuances.
        </p>
        <h6>DISCLOSURE</h6>
        <p>
          We will treat your information with utmost confidentiality and will not disclose it to unauthorized persons unless required by law or for legitimate processing under the Data Privacy Act of 2012.
        </p>
        <p>
          You have the right to access, copy, correct, erase, or block your personal data, and to file a complaint if necessary.
        </p>
        <p>
          For data subject rights, contact our Data Protection Officer at <a href="mailto:dpo@irigacity.gov.ph">dpo@irigacity.gov.ph</a>.
        </p>
        <div class="form-check mt-3">
          <input class="form-check-input" type="checkbox" value="" id="consentCheck">
          <label class="form-check-label" for="consentCheck">
            I hereby give consent to use my personal information for purposes related to my transaction.
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="proceedBtn" class="btn btn-primary" disabled>Yes, I give my consent</button>
      </div>
    </div>
  </div>
</div>

<script>
// Enable the Proceed button only when consent is checked
document.getElementById('consentCheck').addEventListener('change', function() {
    document.getElementById('proceedBtn').disabled = !this.checked;
});

// When user consents, redirect to your transaction form
document.getElementById('proceedBtn').addEventListener('click', function() {
    const code = document.getElementById('transactionCode').value.trim();
    if (!code) {
        alert('Please enter your transaction code first.');
        return;
    }
    // Adjust 'transaction' route as needed
    window.location.href = '<?= base_url('transaction') ?>?code=' + encodeURIComponent(code);
});
</script>

</body>
</html>
