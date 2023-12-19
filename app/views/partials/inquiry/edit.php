<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit  Inquiry</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("inquiry/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="prospect_name">Your Name <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-prospect_name"  value="<?php  echo $data['prospect_name']; ?>" type="text" placeholder="Enter Prospect Name"  required="" name="prospect_name"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="prospect_phone">Contact Number <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-prospect_phone"  value="<?php  echo $data['prospect_phone']; ?>" type="text" placeholder="Enter Prospect Phone"  required="" name="prospect_phone"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="prospect_phone">Event Date <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                <input id="ctrl-datetime" class="form-control datepicker  datepicker" required="" value="<?php echo $this->set_field_value('datetime', $data['event_date']); ?>" type="datetime" name="event_date" placeholder="Event Date" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                        </div>


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="datetime">Event Venue <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-event_venue" class="form-control" required="" value="<?php echo $data['event_venue']; ?>" type="text" name="event_venue" placeholder="Event Venue" />

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="datetime">Number of Pax <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-total_pax" class="form-control" required="" value="<?php echo $data['total_pax']; ?>" type="text" name="total_pax" placeholder="Total Pax" />

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="datetime">Event Space<span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select required="" class="custom-select" name="event_type" id="event_type">
                                                    <?php $field_value = $data['event_type']; ?>
                                                    <option value="G Glass House @ Klang" <?php echo ('G Glass House @ Klang' == $field_value ? 'selected' : null) ?>>G Glass House @ Klang</option>
                                                    <option value="Lena Hall @ Kajang" <?php echo ('Lena Hall @ Kajang' == $field_value ? 'selected' : null) ?>>Lena Hall @ Kajang</option>
                                                    <option value="Lilla Rainforest Retreat @ Hulu Langat" <?php echo ('Lilla Rainforest Retreat @ Hulu Langat' == $field_value ? 'selected' : null) ?>>Lilla Rainforest Retreat @ Hulu Langat</option>
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="datetime">Your Budget <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-budget" class="form-control" required="" value="<?php echo $data['budget']; ?>" type="text" name="budget" placeholder="Budget" />

                                            </div>
                                        </div>
                                    </div>
                                </div>




                                        
                                            <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="platform">Platform </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <select  id="ctrl-platform" name="platform"  placeholder="Select a value ..."    class="custom-select" >
                                                            <option value="">Select a value ...</option>
                                                            <?php
                                                            $platform_options = Menu :: $platform;
                                                            $field_value = $data['platform'];
                                                            if(!empty($platform_options)){
                                                            foreach($platform_options as $option){
                                                            $value = $option['value'];
                                                            $label = $option['label'];
                                                            $selected = ( $value == $field_value ? 'selected' : null );
                                                            ?>
                                                            <option <?php echo $selected ?> value="<?php echo $value ?>">
                                                                <?php echo $label ?>
                                                            </option>                                   
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="platform">Status </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <select  id="ctrl-status" name="status"  placeholder="Select a value ..."    class="custom-select" >
                                                            <option value="">Select a value ...</option>
                                                            <?php
                                                            $field_value = $data['status'];
                                                            ?>
                                                            <option <?php echo ( $value == $field_value ? 'selected' : null ) ?> value="Site Recce">Site Recce</option>
                                                            <option <?php echo ( $value == $field_value ? 'selected' : null ) ?> value="Reserved">Reserved</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="prospect_phone">Total Amount<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-total_amount"  value="<?php  echo $data['total_amount']; ?>" type="text" placeholder="Enter Total Amount"  required="" name="total_amount"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="remark">Remark </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <textarea placeholder="Enter Remark" id="ctrl-remark"  rows="5" name="remark" class=" form-control"><?php  echo $data['remark']; ?></textarea>
                                                        <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="handled">Handled </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <?php
                                                        $handled_options = Menu :: $handled;
                                                        $field_value = $data['handled'];
                                                        if(!empty($handled_options)){
                                                        foreach($handled_options as $option){
                                                        $value = $option['value'];
                                                        $label = $option['label'];
                                                        //check if value is among checked options
                                                        $checked = $this->check_form_field_checked($field_value, $value);
                                                        ?>
                                                        <label class="custom-control custom-radio custom-control-inline">
                                                            <input id="ctrl-handled" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="handled" />
                                                                <span class="custom-control-label"><?php echo $label ?></span>
                                                            </label>
                                                            <?php
                                                            }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-ajax-status"></div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary" type="submit">
                                                Update
                                                <i class="icon-paper-plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
