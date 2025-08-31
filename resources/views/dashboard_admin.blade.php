<x-layout>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Rehsos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countRehsos }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                PPKG</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countPPKG }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Dayasos
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $countDayasos }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Linjamsos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $countLinjamsos }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-3 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progres Rehsos</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Dikirim
                        <span class="float-right">{{ $progressRehsos['dikirim'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar"
                            style="width: {{ $progressRehsos['dikirim'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Diverifikasi
                        <span class="float-right">{{ $progressRehsos['diverifikasi'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar"
                            style="width: {{ $progressRehsos['diverifikasi'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Diproses
                        <span class="float-right">{{ $progressRehsos['diproses'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar"
                            style="width: {{ $progressRehsos['diproses'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Selesai
                        <span class="float-right">{{ $progressRehsos['selesai'] }}%</span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{ $progressRehsos['selesai'] }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progres PPKG</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Dikirim
                        <span class="float-right">{{ $progressPPKG['dikirim'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar"
                            style="width: {{ $progressPPKG['dikirim'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Diverifikasi
                        <span class="float-right">{{ $progressPPKG['diverifikasi'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar"
                            style="width: {{ $progressPPKG['diverifikasi'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Diproses
                        <span class="float-right">{{ $progressPPKG['diproses'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar"
                            style="width: {{ $progressPPKG['diproses'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Selesai
                        <span class="float-right">{{ $progressPPKG['selesai'] }}%</span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{ $progressPPKG['selesai'] }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progres Dayasos</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Dikirim
                        <span class="float-right">{{ $progressDayasos['dikirim'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar"
                            style="width: {{ $progressDayasos['dikirim'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Diverifikasi
                        <span class="float-right">{{ $progressDayasos['diverifikasi'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar"
                            style="width: {{ $progressDayasos['diverifikasi'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Diproses
                        <span class="float-right">{{ $progressDayasos['diproses'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar"
                            style="width: {{ $progressDayasos['diproses'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Selesai
                        <span class="float-right">{{ $progressDayasos['selesai'] }}%</span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{ $progressDayasos['selesai'] }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progres Linjamsos</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Dikirim
                        <span class="float-right">{{ $progressLinjamsos['dikirim'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar"
                            style="width: {{ $progressLinjamsos['dikirim'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Diverifikasi
                        <span class="float-right">{{ $progressLinjamsos['diverifikasi'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar"
                            style="width: {{ $progressLinjamsos['diverifikasi'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Diproses
                        <span class="float-right">{{ $progressLinjamsos['diproses'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar"
                            style="width: {{ $progressLinjamsos['diproses'] }}%"></div>
                    </div>
                    <h4 class="small font-weight-bold">Selesai
                        <span class="float-right">{{ $progressLinjamsos['selesai'] }}%</span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{ $progressLinjamsos['selesai'] }}%"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-layout>
