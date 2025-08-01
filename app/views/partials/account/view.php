<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("user/add");
$can_edit = ACL::is_allowed("user/edit");
$can_view = ACL::is_allowed("user/view");
$can_delete = ACL::is_allowed("user/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">My Account</h4>
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
                <div class="col-md-12 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div class="bg-primary m-2 mb-4">
                            <div class="profile">
                                <div class="avatar"><img src="<?php print_link("assets/images/avatar.png") ?>" /> 
                                </div>
                                <h1 class="title mt-4"><?php echo $data['agent_name']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mx-3 mb-3">
                                    <ul class="nav nav-pills flex-column text-left">
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageView" class="nav-link active">
                                                <i class="icon-user"></i> Account Detail
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageEdit" class="nav-link">
                                                <i class="icon-pencil"></i> Edit Account
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageChangeEmail" class="nav-link">
                                                <i class="icon-envelope-open"></i> Change Email
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#AccountPageChangePassword" class="nav-link">
                                                <i class="icon-key"></i> Reset Password
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active fade" id="AccountPageView" role="tabpanel">
                                            <table class="table table-hover table-borderless table-striped">
                                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                    <tr  class="td-id">
                                                        <th class="title"> Id: </th>
                                                        <td class="value"> <?php echo $data['id']; ?></td>
                                                    </tr>
                                                    <tr  class="td-username">
                                                        <th class="title"> Username: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['username']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="username" 
                                                                data-title="Enter Username" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="email" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['username']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-agent_name">
                                                        <th class="title"> Agent Name: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['agent_name']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="agent_name" 
                                                                data-title="Enter Agent Name" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="email" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['agent_name']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-phone_number">
                                                        <th class="title"> Phone Number: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['phone_number']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="phone_number" 
                                                                data-title="Enter Phone Number" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['phone_number']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-remark">
                                                        <th class="title"> Remark: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['remark']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="remark" 
                                                                data-title="Enter Remark" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['remark']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-role">
                                                        <th class="title"> Role: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $role); ?>' 
                                                                data-value="<?php echo $data['role']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="role" 
                                                                data-title="Select a value ..." 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="select" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['role']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-priority">
                                                        <th class="title"> Priority: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['priority']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="priority" 
                                                                data-title="Enter Priority" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="number" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['priority']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-status">
                                                        <th class="title"> Status: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['status']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="status" 
                                                                data-title="Enter Status" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="number" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['status']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-pass_text">
                                                        <th class="title"> Pass Text: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['pass_text']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="pass_text" 
                                                                data-title="Enter Pass Text" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['pass_text']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr  class="td-agency">
                                                        <th class="title"> Agency: </th>
                                                        <td class="value">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['agency']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("user/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="agency" 
                                                                data-title="Enter Agency" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['agency']; ?> 
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>    
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageEdit" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("account/edit"); ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane  fade" id="AccountPageChangeEmail" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("account/change_email"); ?>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageChangePassword" role="tabpanel">
                                            <div class=" reset-grids">
                                                <?php  $this->render_page("passwordmanager"); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        else{
                        ?>
                        <!-- Empty Record Message -->
                        <div class="text-muted p-3">
                            <i class="icon-ban"></i> No Record Found
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
