







<!-- Street -->
<div class="form-group">
  <label>Street</label>
  <input type="text" name="street" class="form-control" value="<?php echo isset ($row['street'])?$row['street']:''; ?>">
</div>

<!-- City -->
<div class="form-group">
  <label>City</label>
  <input type="text" name="city" class="form-control" value="<?php echo isset ($row['city'])?$row['city']:''; ?>">
</div>

<!-- State/province -->
<div class="form-group">
  <label>State/Province</label>
  <input type="text" name="state" class="form-control" value="<?php echo isset ($row['state'])?$row['state']:''; ?>">
</div>

<!-- Zip -->
<div class="form-group">
  <label>ZIP</label>
  <input type="text" name="zip" class="form-control" value="<?php echo isset ($row['zip'])?$row['zip']:''; ?>">
</div>

<!-- Country -->
<div class="form-group">
  <label>Country</label>
  <input type="text" name="country" class="form-control" value="<?php echo isset ($row['country'])?$row['country']:''; ?>">
</div>

<!-- Address type -->
<div class="form-group <?php echo(!empty($err_address_type)) ? 'has-error' : ''; ?>">
  <label>Address Type</label>
  <select name="type">
    <option value="invoice" <?php if($row['type'] == 'invoice') echo 'selected="selected"'; ?>>Invoice</option>
    <option value="mailing" <?php if($row['type'] == 'mailing') echo 'selected="selected"'; ?>>Mailing</option>
    <option value="shipping" <?php if($row['type'] == 'shipping') echo 'selected="selected"'; ?>>Shipping</option>
    <option value="site" <?php if($row['type'] == 'site') echo 'selected="selected"'; ?>>Site</option>
  </select>
</div>
