<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        TEAM 7 SIBOL
        <!-- <img src="{{ asset('img/logo/binus-SIS.svg')}}" width="100" height="46"\> -->
        <!-- <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg> -->
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Home')" />
        </li>

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password') ||
                $logged_in_user->can('admin.access.notaris')
            )
        )
            <!-- <li class="c-sidebar-nav-title">@lang('System')</li> -->

            <li class="c-sidebar-nav-dropdown {{ 
                activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*') 
                || Route::is('admin.access.notaris*') || Route::is('admin.access.cluster*'), 
                'c-open c-show') 
            }}">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-applications-settings"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Master')" />

                <ul class="c-sidebar-nav-dropdown-items">

                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.notaris') ||
                            $logged_in_user->can('admin.access.notaris.index') ||
                            $logged_in_user->can('admin.access.notaris.create') ||
                            $logged_in_user->can('admin.access.notaris.edit') ||
                            $logged_in_user->can('admin.access.notaris.destroy')
                        )
                    )

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('notaris.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Data Notaris ')"
                                :active="activeClass(Route::is('notaris.*'), 'c-active')" />
                        </li>
                    @endif

                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.cluster') ||
                            $logged_in_user->can('admin.access.cluster.index') ||
                            $logged_in_user->can('admin.access.cluster.create') ||
                            $logged_in_user->can('admin.access.cluster.edit') ||
                            $logged_in_user->can('admin.access.cluster.destroy')
                        )
                    )

                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('cluster.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Data Cluster ')"
                                :active="activeClass(Route::is('cluster.*'), 'c-active')" />
                        </li>
                    @endif

                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.user.list') ||
                            $logged_in_user->can('admin.access.user.deactivate') ||
                            $logged_in_user->can('admin.access.user.reactivate') ||
                            $logged_in_user->can('admin.access.user.clear-session') ||
                            $logged_in_user->can('admin.access.user.impersonate') ||
                            $logged_in_user->can('admin.access.user.change-password')
                        )
                    )
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.user.index')"
                                class="c-sidebar-nav-link"
                                :text="__('User Management')"
                                :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                        </li>
                    @endif

                    @if ($logged_in_user->hasAllAccess())
                        <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.role.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Role Management')"
                                :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                        </li>
                        <!-- <li class="c-sidebar-nav-item">
                            <x-utils.link
                                :href="route('admin.auth.permission.index')"
                                class="c-sidebar-nav-link"
                                :text="__('Permission Management')"
                                :active="activeClass(Route::is('admin.auth.permission.*'), 'c-active')" />
                        </li> -->
                        
                    @endif

                </ul>
            </li>
        @endif

        @if ($logged_in_user->hasAllAccess())
            <!-- <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-list"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Logs')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
            </li> -->
        @endif

        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.covernote') ||
                $logged_in_user->can('admin.access.covernote.index') ||
                $logged_in_user->can('admin.access.covernote.create') ||
                $logged_in_user->can('admin.access.covernote.edit') ||
                $logged_in_user->can('admin.access.covernote.destroy') ||
                $logged_in_user->can('admin.access.covernote_document.list') ||
                $logged_in_user->can('admin.access.covernote_document.update') ||
                $logged_in_user->can('admin.access.covernote_document.followup') 
            )
        )
        <!-- <li class="c-sidebar-nav-title">@lang('Covernote')</li> -->

           <!-- <li class="c-sidebar-nav-item"> -->
           <li class="c-sidebar-nav-dropdown">
               <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-description"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Covernote')" 
                    :active="activeClass(Route::is('covernote.*'), 'c-open c-show')" />

                <ul class="c-sidebar-nav-dropdown-items">
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.covernote') ||
                            $logged_in_user->can('admin.access.covernote.index') ||
                            $logged_in_user->can('admin.access.covernote.create') ||
                            $logged_in_user->can('admin.access.covernote.edit') ||
                            $logged_in_user->can('admin.access.covernote.destroy')
                        )
                    )

                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('covernote.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Data Covernote')" 
                            :active="activeClass(Route::is('covernote.index') || Route::is('covernote.create') || Route::is('covernote.edit'), 'c-active')" />
                    </li>

                    @endif
                    @if (
                        $logged_in_user->hasAllAccess() ||
                        (
                            $logged_in_user->can('admin.access.covernote_document.list') ||
                            $logged_in_user->can('admin.access.covernote_document.update') ||
                            $logged_in_user->can('admin.access.covernote_document.followup') 
                        )
                    )

                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('covernote.document.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Dokumen Covernote')" />
                    </li>
                    @endif
                </ul>
            </li>

            @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.report') ||
                $logged_in_user->can('admin.access.report.grup_hukum') ||
                $logged_in_user->can('admin.access.report.outstanding_notaris') ||
                $logged_in_user->can('admin.access.report.kinerja_notaris') ||
                $logged_in_user->can('admin.access.report.notaris')
            )
            )
            <li class="c-sidebar-nav-dropdown">
                <x-utils.link
                    href="#"
                    icon="c-sidebar-nav-icon cil-spreadsheet"
                    class="c-sidebar-nav-dropdown-toggle"
                    :text="__('Report')"
                    :active="activeClass(Route::is('letter.group_hukum.*') || Route::is('report.*'), 'c-active')" />
                <ul class="c-sidebar-nav-dropdown-items">
                    @if($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.report') || $logged_in_user->can('admin.access.report.grup_hukum')) )
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('letter.grup_hukum.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Laporan Grup Hukum')"
                            :active="activeClass(Route::is('letter.group_hukum.*'), 'c-active')" />
                    </li>
                    @endif
                    @if($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.report') || $logged_in_user->can('admin.access.report.outstanding_notaris')) )

                    <li class="c-sidebar-nav-item">
                    <!-- icon="c-sidebar-nav-icon cil-envelope-letter" -->
                        <x-utils.link
                            :href="route('letter.tagihan.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Laporan Outstanding Notaris')"
                            :active="activeClass(Route::is('letter.tagihan.*'), 'c-active')" />
                    </li>
                    @endif
                    @if($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.report') || $logged_in_user->can('admin.access.report.kinerja_notaris')) )
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('report.kinerja.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Laporan Kinerja Notaris')"
                            :active="activeClass(Route::is('report.kinerja.*'), 'c-active')" />
                    </li>
                    @endif
                    @if($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.report') || $logged_in_user->can('admin.access.report.notaris')) )
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('report.notaris.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Laporan notaris')"
                            :active="activeClass(Route::is('report.notaris.*'), 'c-active')" />
                    </li>
                    @endif

                </ul>

            </li>

            @endif
           
            <!-- <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('covernote.index')"
                    icon="c-sidebar-nav-icon cil-description"
                    class="c-sidebar-nav-link"
                    :text="__('Covernote')"
                    :active="activeClass(Route::is('covernote.*'), 'c-active')" />
            </li> -->
        @endif
        @if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.inquiry') ||
                $logged_in_user->can('admin.access.inquiry.status_akta') ||
                $logged_in_user->can('admin.access.inquiry.index_notaris') ||
                $logged_in_user->can('admin.access.inquiry.surat_tagihan') ||
                $logged_in_user->can('admin.access.inquiry.grup_hukum')
            )
        )
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link
                href="#"
                icon="c-sidebar-nav-icon cil-library"
                class="c-sidebar-nav-dropdown-toggle"
                :text="__('Inquiry')"
                :active="activeClass(Route::is('inquiry.*'), 'c-active')" />
            <ul class="c-sidebar-nav-dropdown-items">
                @if($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.inquiry') || $logged_in_user->can('admin.access.inquiry.status_akta')) )
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('inquiry.status_akta.index')"
                        class="c-sidebar-nav-link"
                        :text="__('Status Dokumen')" 
                        :active="activeClass(Route::is('inquiry.status_akta.*'), 'c-active')" />
                </li>
                @endif
                @if($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.inquiry') || $logged_in_user->can('admin.access.inquiry.index_notaris')) )
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('inquiry.index_notaris.index')"
                        class="c-sidebar-nav-link"
                        :text="__('Index Notaris')" 
                        :active="activeClass(Route::is('inquiry.index_notaris.*'), 'c-active')" />
                </li>
                @endif
                @if($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.inquiry') || $logged_in_user->can('admin.access.inquiry.surat_tagihan')) )
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('inquiry.tagihan_notaris.index')"
                        class="c-sidebar-nav-link"
                        :text="__('Surat Tagihan Notaris')"
                        :active="activeClass(Route::is('inquiry.tagihan_notaris.*'), 'c-active')" />
                </li>
                @endif
                @if($logged_in_user->hasAllAccess() || ($logged_in_user->can('admin.access.inquiry') || $logged_in_user->can('admin.access.inquiry.grup_hukum')) )
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('inquiry.grup_hukum.index')"
                        class="c-sidebar-nav-link"
                        :text="__('Laporan Grup Hukum')" 
                        :active="activeClass(Route::is('inquiry.grup_hukum.*'), 'c-active')" />
                </li>
                @endif
            </ul>
        </li>

        @endif

    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
