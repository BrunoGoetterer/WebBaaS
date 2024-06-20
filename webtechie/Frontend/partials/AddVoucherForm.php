<form id="add-voucher-form">
    <div class="mb-3">
        <label for="value" class="form-label">Value</label>
        <input type="number" class="form-control" id="value" name="value" required>
    </div>
    <div class="mb-3">
        <label for="expiry_date" class="form-label">Expiry Date</label>
        <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Voucher</button>
</form>

<!-- Einbinden der JavaScript-Datei zur Verarbeitung des Formulars -->
<script src='../js/add_voucher_form.js'></script>