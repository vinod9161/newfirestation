<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="#" class="header-logo">
            <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-logo">
            <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-logo">
            <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-dark">
            <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-dark">
            <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-white">
            <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-white">
        </a>
    </div>
    <!-- End::main-sidebar-header -->
    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">
        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide -->
                <li class="slide">
                    <a href="<?php echo route('admin.dashboard'); ?>" class="side-menu__item">
                        <i class="fe fe-airplay side-menu__icon"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <!-- Start::slide -->
                @if(Auth::user()->id == '1')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-box side-menu__icon"></i>
                        <span class="side-menu__label">Locations</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)" style="padding-left: 35px;">Locations</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.district') }}" class="side-menu__item"
                                style="padding-left: 35px;">Districts</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.tehsil') }}" class="side-menu__item"
                                style="padding-left: 35px;">Tehsils</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.block') }}" class="side-menu__item"
                                style="padding-left: 35px;">Blocks</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.panchayat') }}" class="side-menu__item"
                                style="padding-left: 35px;">Penchayat</a>
                        </li>
                    </ul>
                </li>
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-box side-menu__icon"></i>
                        <span class="side-menu__label">Service Management</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('services.index') }}" style="padding-left: 35px;">Services</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('pricing-rules.index') }}" class="side-menu__item"
                                style="padding-left: 35px;">Pricing Rules</a>
                        </li>

                        <li class="slide">
                            <a href="{{ route('personnel-expense.index') }}"
                                class="side-menu__item"
                                style="padding-left:35px;">
                                Personnel Expense
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('report-fee-master.index') }}"
                                class="side-menu__item"
                                style="padding-left:35px;">
                                Report Fee Master
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- End::slide -->

                <!-- Start::Categories & Sub Categories -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-codepen side-menu__icon"></i>
                        <span class="side-menu__label">Categories</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.category') }}" class="side-menu__item"
                                style="padding-left: 35px;">Category</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.subcategory') }}" class="side-menu__item"
                                style="padding-left: 35px;">Sub Category</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.projects') }}" class="side-menu__item"
                                style="padding-left: 35px;">Projects</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.type') }}" class="side-menu__item"
                                style="padding-left: 35px;">Types</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Categories & Sub Categories -->

                <!-- Start::Fire NOC -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-codepen side-menu__icon"></i>
                        <span class="side-menu__label">Department</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.review') }}" class="side-menu__item"
                                style="padding-left: 35px;">Review Officer</a>

                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.deptydirector') }}" class="side-menu__item"
                                style="padding-left: 35px;">Deputy Director</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.cfo') }}" class="side-menu__item"
                                style="padding-left: 35px;">CFO</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.fso') }}" class="side-menu__item"
                                style="padding-left: 35px;">FSO</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.stations')}}" class="side-menu__item"
                                style="padding-left: 35px;">Stations</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Fire NOC -->
                @endif

                <!-- Start Equipment -->
                <li class="slide">
                    <a href="{{ route('admin.equipmentlist') }}" class="side-menu__item">
                        <i class="fe fe-cpu side-menu__icon"></i>
                        <span class="side-menu__label">Equipments</span>
                    </a>
                </li>
                <!-- End Equipment -->

                @if(Auth::user()->type == 3)

                <li class="slide">

                    <a href="{{ route('service-bills.index') }}"
                        class="side-menu__item">

                        <i class="bx bx-file side-menu__icon"></i>

                        <span class="side-menu__label">
                            Service Bills
                        </span>

                    </a>

                </li>

                @endif

                <!-- Start::Fire NOC -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-codepen side-menu__icon"></i>
                        <span class="side-menu__label">Fire Noc</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.Noc.list',['status'=>'all']) }}" class="side-menu__item" style="padding-left: 35px;">All</a>
                        </li>
                        <!-- <li class="slide">
                            <a href="{{ route('admin.Noc',['type'=>'new']) }}" class="side-menu__item" style="padding-left: 35px;">New</a>
                        </li> -->
                        <li class="slide">
                            <a href="{{ route('admin.Noc.list',['status'=>'approved'])}}" class="side-menu__item" style="padding-left: 35px;">Approved</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.Noc.list',['status'=>'processed'])}}" class="side-menu__item" style="padding-left: 35px;">In Process</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.Noc.list',['status'=>'pending'])}}" class="side-menu__item" style="padding-left: 35px;">Pending</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.Noc.list',['status'=>'reverted'])}}" class="side-menu__item" style="padding-left: 35px;"> Reverted</a>
                        </li>
                    </ul>
                </li>
                <!-- End::Fire NOC -->

                <li class="slide">
                    <a href="{{ route('admin.indexTemporaryNoc') }}" class="side-menu__item">
                        <i class="fe fe-database side-menu__icon"></i>
                        <span class="side-menu__label">Temporary NOC</span>
                    </a>
                </li>
                @if(Auth::user()->id == '1')
                <li class="slide">
                    <a href="{{ route('admin.remark') }}" class="side-menu__item">
                        <i class="fe fe-database side-menu__icon"></i>
                        <span class="side-menu__label">NOC Remarks</span>
                    </a>
                </li>
                @endif

                <li class="slide">
                    <a href="{{ route('admin.fire_report') }}" class="side-menu__item">
                        <i class="fe fe-database side-menu__icon"></i>
                        <span class="side-menu__label">Fire Report</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.rescueReport') }}" class="side-menu__item">
                        <i class="fe fe-database side-menu__icon"></i>
                        <span class="side-menu__label">Rescue Report</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.reliefReport') }}" class="side-menu__item">
                        <i class="fe fe-database side-menu__icon"></i>
                        <span class="side-menu__label">Relief Report</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.hydrant') }}" class="side-menu__item">
                        <i class="fe fe-database side-menu__icon"></i>
                        <span class="side-menu__label">Hydrant</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.vehicle') }}" class="side-menu__item">
                        <i class="fe fe-database side-menu__icon"></i>
                        <span class="side-menu__label">Vehicle and Machine</span>
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.employees') }}" class="side-menu__item">
                        <i class="fe fe-database side-menu__icon"></i>
                        <span class="side-menu__label">Employee Corner</span>
                    </a>
                </li>


                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-codepen side-menu__icon"></i>
                        <span class="side-menu__label">Fire Activities</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.standby') }}" class="side-menu__item"
                                style="padding-left: 35px;">Stand By Duty</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.awareness') }}" class="side-menu__item"
                                style="padding-left: 35px;">Awareness Program</a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.incident') }}" class="side-menu__item"
                                style="padding-left: 35px;">Fire/Rescue/Incident Report</a>
                        </li>
                    </ul>
                </li>


                @if(Auth::user()->id == '1')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fe fe-book side-menu__icon"></i>
                        <span class="side-menu__label">CMS</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1"
                        style="position: relative; left: 0px; top: 0px; margin: 0px; transform: translate3d(12px, 364px, 0px); display: block; box-sizing: border-box;"
                        data-popper-placement="top" data-popper-reference-hidden="">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">CMS</a>
                        </li>
                        <!---->
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Other Page <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="{{ route('admin.specialriskarea') }}" class="side-menu__item">Special Risk Area</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.recentfireincidents') }}" class="side-menu__item">Recent Fire Incidents</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.staffstrength') }}" class="side-menu__item">Staff Strength</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.getserviceorder') }}" class="side-menu__item">Service Order</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.getwelfareamenity') }}" class="side-menu__item">Welfare and Amenity</a>
                                </li>

                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Home <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a href="{{ route('admin.recentupdates') }}" class="side-menu__item">Recent Updates</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.getbannerslider') }}" class="side-menu__item">Banner Slider</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.leadershipSectionList') }}" class="side-menu__item">Leadership Section</a>
                                </li>
                            </ul>
                        </li>

                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">About <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2" style="display: block; box-sizing: border-box;">
                                <li class="slide">
                                    <a href="{{route('admin.about.history')}}" class="side-menu__item">History</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.about.missionvision')}}"
                                        class="side-menu__item">Mission-Vision</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.about.our_objective') }}" class="side-menu__item">Our Objective</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.organisational') }}" class="side-menu__item">Organisational Structure</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.about.dg_message') }}" class="side-menu__item">DG's Message</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.about.Fire_Service_Day') }}" class="side-menu__item">Fire Service Day</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.about.flag_day') }}" class="side-menu__item">Flag Day</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.about.faq') }}" class="side-menu__item">FAQ's</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('admin.about.tutorial') }}" class="side-menu__item">Tutorials</a>
                                </li>
                                <!-- <li class="slide">
                                    <a href="#" class="side-menu__item">Logs</a>
                                </li> -->
                            </ul>
                        </li>

                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Services <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2" style="display: block; box-sizing: border-box;">
                                <li class="slide">
                                    <a href="{{route('admin.Service.RTI')}}" class="side-menu__item">RTI </a>
                                </li>

                                <li class="slide">
                                    <a href="{{route('admin.Service.rtiservices')}}" class="side-menu__item">Right To Service </a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.services.fire-operation')}}" class="side-menu__item">Fire Fighting</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.services.standby')}}" class="side-menu__item">Stand By</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.services.pumping_work')}}" class="side-menu__item">Pumping Work</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.services.rendered_paid')}}" class="side-menu__item">Service
                                        rendered paid
                                    </a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.services.rendered_unpaid')}}" class="side-menu__item">Service
                                        rendered Unpaid
                                    </a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.services.awarness_mock_drill')}}" class="side-menu__item">Awareness/Mock drill
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Achivements <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2" style="display: block; box-sizing: border-box;">
                                <li class="slide">
                                    <a href="{{route('admin.achievement')}}" class="side-menu__item">Achievements</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.achivements.medal_category')}}" class="side-menu__item">Medal Category</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.achivements.medal_winners')}}" class="side-menu__item">Medal Winners</a>
                                </li>
                            </ul>
                        </li>

                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Activities <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2" style="display: block; box-sizing: border-box;">
                                <li class="slide">
                                    <a href="{{route('admin.activities.galary')}}" class="side-menu__item">Gallery</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.Activities.fire_service_week')}}" class="side-menu__item">Fire Service Week</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.getpublicarticle')}}" class="side-menu__item">public Articles</a>
                                </li>

                            </ul>
                        </li>


                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Academy <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2" style="display: block; box-sizing: border-box;">
                                <li class="slide">
                                    <a href="{{route('admin.getrecruitment')}}" class="side-menu__item">Recruitment</a>
                                </li>

                                <li class="slide">
                                    <a href="{{route('admin.gethistory')}}" class="side-menu__item">History</a>
                                </li>

                                <li class="slide">
                                    <a href="{{route('admin.getroutemap')}}" class="side-menu__item">Route Map</a>
                                </li>

                                <li class="slide">
                                    <a href="{{route('admin.getistitutionalstructure')}}" class="side-menu__item">Institutional Structure</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.getresult')}}" class="side-menu__item">Result</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.gettrainingschedule')}}" class="side-menu__item">Training Schedule</a>
                                </li>
                                <li class="slide">
                                    <a href="{{route('admin.getcourse')}}" class="side-menu__item">Course</a>
                                </li>

                            </ul>
                        </li>

                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Noc <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2" style="display: block; box-sizing: border-box;">
                                <li class="slide">
                                    <a href="{{ route('admin.getnocdocrequire') }}" class="side-menu__item">Required Document for NOC</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ route('admin.getchecklist') }}" class="side-menu__item">NOC Checklist</a>
                                </li>
                            </ul>
                        </li>


                        <li class="slide has-sub">
                            <a href="javascript:void(0);" class="side-menu__item">Contact Address <i
                                    class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2" style="display: block; box-sizing: border-box;">
                                <li class="slide">
                                    <a href="{{ Route('admin.contactinfo')}}" class="side-menu__item">Contact info</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
    </div>
</aside>