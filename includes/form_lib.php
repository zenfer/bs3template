<?php
//$oForm->text($element = '', $value = '', $placeholder = '', $label = '', $class = '', $required);
//$oForm->textattribute($element = '', $value = '', $placeholder = '', $label = '', $class = '', $required, $attribute = '', $attribute_value = '');
//$oForm->password($element = '', $value = '', $placeholder = '', $label = '', $class = '', $required = false);
//$oForm->textarea($element = '', $value = '', $placeholder = '', $label = '', $class = '', $rows = '10')
//$oForm->hidden($element='',$value='');
//$oForm->select($element = 'myelement', $label = 'My Label', $query = '', $class = '', $selected = '');
//$oForm->select_active($element = 'active', $label = 'Active', $initial = '1', $class = '')
//$oForm->select_array($element= '', $label = '', $class = '', $input, $selected);
//$oForm->yesno($element = 'myelement', $label = 'My Label');
//file($element = '', $label = '', $class = '') {

require_once 'includes/db_lib.php';

class form_object {

    public function text($element = 'myelement', $value = 'myvalue', $placeholder = 'value', $label = 'my label', $class = '', $required = false) {
        //$element = str_replace(' ', '_', $element);
        ?>
        <div class="form-group margin-bottom-0">
            <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
            <input class='form-control <?php echo $class; ?>' type='text' name='<?php echo $element; ?>' value='<?php echo $value; ?>' placeholder='<?php echo $placeholder; ?>' <?php if ($required) echo 'required'; ?> />
        </div>
        <?php
        return true;
    }

    public function password($element = 'myelement', $value = 'myvalue', $placeholder = 'value', $label = 'my label', $class = '', $required = false) {
        ?>
        <div class="form-group margin-bottom-0">
            <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
            <input class='form-control <?php echo $class; ?>' type='password' name='<?php echo $element; ?>' value='<?php echo $value; ?>' placeholder='<?php echo $placeholder; ?>' <?php if ($required) echo 'required'; ?> />
        </div>
        <?php
        return true;
    }

    public function textattribute($element = 'myelement', $value = 'myvalue', $placeholder = 'value', $label = 'my label', $class = '', $required = false, $attribute = '', $attribute_value = '') {
        //$element = str_replace(' ', '_', $element);
        ?>
        <div class="form-group margin-bottom-0">
            <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
            <input class='form-control <?php echo $class; ?>' type='text' name='<?php echo $element; ?>' value='<?php echo $value; ?>' placeholder='<?php echo $placeholder; ?>' <?php if ($required) echo 'required'; ?> <?php echo $attribute; ?> = "<?php echo $attribute_value; ?>" />
        </div>
        <?php
        return true;
    }

    public function textarea($element = 'myelement', $value = 'myvalue', $placeholder = 'value', $label = 'my label', $class = '', $rows = '10', $id = '') {
        ?>
        <div class="form-group margin-bottom-0">
            <label for='<?php echo $label; ?>'><?php echo $label; ?></label>
            <textarea id="<?php echo $id; ?>" name='<?php echo $element; ?>' rows= '<?php echo $rows; ?>' class='form-control <?php echo $class; ?>'><?php echo $value; ?></textarea>
        </div>
        <?php
    }

    public function select($element = 'myelement', $label = 'My Label', $query = '', $class = '', $selected = '') {
        global $oDB;
        if (empty($query)) {
            echo "No query specified.'<br>'";
        } else {
            ?>
            <div class="form-group margin-bottom-0">
                <label for='<?php echo $label; ?>'><?php echo $label; ?></label>
                <select class="form-control <?php echo $class; ?>" name="<?php echo $element; ?>">
                    <?php
                    //$query = "select * from shipment_carriers where shop_id = $shop_id order by shipment_carrier_name desc";
                    $result = $oDB->select($query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['a'] == $selected) {
                            ?>
                            <option selected value="<?php echo $row['a']; ?>"><?php echo $row['b']; ?></option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $row['a']; ?>"><?php echo $row['b']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <?php
        }
    }

    public function yesno($element = 'myelement', $label = 'My Label') {
        ?>
        <div class="form-group margin-bottom-0">
            <label for='<?php echo $label; ?>'><?php echo $label; ?></label>
            <select class="form-control <?php echo $class; ?>" name="<?php echo $element; ?>">
                <option value="1">Yes</option>
                <option value="0">No</option>

            </select>
        </div>
        <?php
    }

    public function select_active($element = 'active', $label = 'Active', $initial = '1', $class = '') {
        global $oDB;
        ?>
        <div class="form-group margin-bottom-0">
            <label for='<?php echo $label; ?>'><?php echo $label; ?></label>
            <select class="form-control <?php echo $class; ?>" name="<?php echo $element; ?>">
                <?php
                if ($initial == 1) {
                    ?>
                    <option value = "1" selected>Enable</option>
                    <option value = "0">Disable</option>
                    <?php
                } else {
                    ?>
                    <option value = "1">Enable</option>
                    <option value = "0" selected>Disable</option>
                    <?php
                }
                ?>
            </select>
        </div>
        <?php
    }

    public function select_array($element, $label = '', $class = '', $input, $selected = '') {
        ?>
        <div class="form-group margin-bottom-0">
            <label for='<?php echo $label; ?>'><?php echo $label; ?></label>
            <select class="form-control <?php echo $class; ?>" name="<?php echo $element; ?>">
                <?php
                foreach ($input as $item) {
                    if ($item == $selected) {
                        ?>
                        <option selected value = "<?php echo $item ?>"><?php echo $item ?></option>
                        <?php
                    } else {
                        ?>
                        <option value = "<?php echo $item ?>"><?php echo $item ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <?php
    }

    public function submit($submit = 'Submit') {
        ?>
        <div class="form-group margin-top-10 margin-bottom-10">
            <button type="submit" class="btn btn-default"><?php echo $submit; ?></button>
        </div>
        <?php
    }

    public function hidden($element = 'myelement', $value = 'myvalue') {
        ?>
        <div class="form-group margin-bottom-0">
            <input class='form-control' type='hidden' name='<?php echo $element; ?>' value='<?php echo $value; ?>' />
        </div>
        <?php
        return true;
    }

    public function file($element = 'myelement', $label = 'my label', $class = '') {
        ?>
        <div class="form-group margin-bottom-0">
            <label for="<?php echo $label; ?>"><?php echo $label; ?></label>
            <input class="form-control <?php echo $class; ?>" type="file" name="<?php echo $element; ?>" id="file" />
        </div>
        <?php
        return true;
    }

}

global $oForm;
$oForm = new form_object;
