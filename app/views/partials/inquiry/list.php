<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("inquiry/add");
$can_edit = ACL::is_allowed("inquiry/edit");
$can_view = ACL::is_allowed("inquiry/view");
$can_delete = ACL::is_allowed("inquiry/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Inquiry</h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                     <a  class="btn btn btn-primary my-1" href="<?php print_link("inquiry/add") ?>">
                        <i class="icon-plus"></i>                               
                        Add New Inquiry 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('inquiry'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="icon-magnifier"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('inquiry'); ?>">
                                            <i class="icon-arrow-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('inquiry'); ?>">
                                            <i class="icon-arrow-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="my-1">
            <div class="container">
                <div class="row ">
                    <div class="col-sm-10 comp-grid">
                    </div>
                    <div class="col-sm-2 comp-grid">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Handle Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php 
                                $option_list = $comp_model->inquiry_inquiryhandled_option_list();
                                if(!empty($option_list)){
                                foreach($option_list as $option){
                                $value = (!empty($option['value']) ? $option['value'] : null);
                                $label = (!empty($option['label']) ? $option['label'] : $value);
                                $nav_link = $this->set_current_page_link(array('inquiry_handled' => $value , 'inquiry_handledlabel' => $label) , false);
                                ?>
                                <a class="dropdown-item <?php echo is_active_link('inquiry_handled', $value); ?>" href="<?php print_link($nav_link) ?>">
                                    <?php echo $label; ?>
                                </a>
                                <?php
                                }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <?php $this :: display_page_errors(); ?>
                            <div class="filter-tags mb-2">
                                <?php
                                if(!empty(get_value('inquiry_handled'))){
                                ?>
                                <div class="filter-chip card bg-light">
                                    <b>Inquiry Handled :</b> 
                                    <?php 
                                    if(get_value('inquiry_handledlabel')){
                                    echo get_value('inquiry_handledlabel');
                                    }
                                    else{
                                    echo get_value('inquiry_handled');
                                    }
                                    $remove_link = unset_get_value('inquiry_handled', $this->route->page_url);
                                    ?>
                                    <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                        &times;
                                    </a>
                                </div>
                                <?php
                                }
                                ?>
                            </div></form>
                            <div  class=" animated fadeIn page-content">
                                <div id="inquiry-list-records">
                                    <div id="page-report-body" class="table-responsive">
                                        <table class="table  table-striped table-sm text-left table-bordered">
                                            <thead class="table-header bg-light">
                                                <tr>
                                                    <th class="td-btn"></th>
                                                    <th class="td-sno">#</th>
                                                    <th  class="td-id"> Id</th>
                                                    <th  class="td-prospect_name"> Prospect Name</th>
                                                    <th  class="td-prospect_phone"> Prospect Phone</th>
                                                    <th  class="td-event_date"> Event Date</th>
                                                    <th  class="td-event_venue"> Event Venue</th>

                                                    <th  class="td-total_pax"> Total Pax</th>
                                                    <th  class="td-event_type"> Event Space</th>
                                                    <th  class="td-budget"> Budget</th>
                                                    
                                                    <th  class="td-datetime"> Datetime</th>
                                                    <th  class="td-assign_agent_name"> Assign Agent</th>
                                                    <th  class="td-status"> Status</th>
                                                    <th  class="td-total_amount"> Total Amount</th>
                                                    <th  class="td-remark"> Remark</th>
                                                    <th  class="td-platform">Platform</th>
                                                    <th  class="td-handled"> Handled</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            if(!empty($records)){
                                            ?>
                                            <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                <!--record-->
                                                <?php
                                                $counter = 0;
                                                foreach($records as $data){
                                                $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                                $counter++;
                                                ?>
                                                <tr>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="page-list-action td-btn">
                                                        <div class="dropdown" >
                                                            <button data-toggle="dropdown" class="dropdown-toggle btn btn-primary btn-sm">
                                                                <i class="icon-menu"></i> 
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <?php if($can_view){ ?>
                                                                <a class="dropdown-item" href="<?php print_link("inquiry/view/$rec_id"); ?>">
                                                                    <i class="icon-eye"></i> View 
                                                                </a>
                                                                <?php } ?>
                                                                <?php if($can_edit){ ?>
                                                                <a class="dropdown-item" href="<?php print_link("inquiry/edit/$rec_id"); ?>">
                                                                    <i class="icon-pencil"></i> Edit
                                                                </a>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td class="td-id"><a href="<?php print_link("inquiry/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
                                                    <td class="td-prospect_name"> <?php echo $data['prospect_name']; ?></td>
                                                    <td class="td-prospect_phone"><a href="<?php print_link("tel:$data[prospect_phone]") ?>"><?php echo $data['prospect_phone']; ?></a></td>
                                                    
                                                    <td class="td-event_date"> <?php echo $data['event_date']; ?></td>

                                                    <td class="td-event_venue"> <?php echo $data['event_venue']; ?></td>

                                                    <td class="td-total_pax"> <?php echo $data['total_pax']; ?></td>
                                                    <td class="td-event_type"> <?php echo $data['event_type']; ?></td>
                                                    <td class="td-budget"> <?php echo $data['budget']; ?></td>
                                                    

                                                    <td class="td-datetime"> <?php echo $data['datetime']; ?></td>
                                                    <td class="td-assign_agent_name"> <?php echo $data['assign_agent_name']; ?></td>
                                                    <td class="td-status"> <?php echo $data['status']; ?></td>
                                                    <td class="td-total_amount"> <?php echo $data['total_amount']; ?></td>
                                                    <td class="td-remark"> <?php echo $data['remark']; ?></td>
                                                    <td class="td-platform"> <?php echo $data['platform']; ?></td>
                                                    <td class="td-handled"><?php Html :: check_button($data['handled'], "true") ?></td>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <?php 
                                        if(empty($records)){
                                        ?>
                                        <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                            <i class="icon-ban"></i> No record found
                                        </h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if( $show_footer && !empty($records)){
                                    ?>
                                    <div class=" border-top mt-2">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="icon-printer"></i> Export
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                </a>
                                                                <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                    </a>
                                                                    <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                        </a>
                                                                        <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                            </a>
                                                                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">   
                                                                    <?php
                                                                    if($show_pagination == true){
                                                                    $pager = new Pagination($total_records, $record_count);
                                                                    $pager->route = $this->route;
                                                                    $pager->show_page_count = true;
                                                                    $pager->show_record_count = true;
                                                                    $pager->show_page_limit =true;
                                                                    $pager->limit_count = $this->limit_count;
                                                                    $pager->show_page_number_list = true;
                                                                    $pager->pager_link_range=5;
                                                                    $pager->render();
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                               <!--  <hr />
                                                <div class="form-group text-center">
                                                    <button class="btn btn-primary">Filter</button>
                                                </div>
                                            </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
