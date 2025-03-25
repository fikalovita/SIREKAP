<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class PeriksaLab  extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPemeriksaanLaborat');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Periksa Laboratorium';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('v_periksa_lab');
        $this->load->view('layout/footer');
    }

    public function dataPeriksaLab()
    {
        $tglAwal = $this->input->post('tglAwal') ?: date('d-m-Y');
        $tglAkhir = $this->input->post('tglAkhir') ?: date('d-m-Y');
        $start = $this->input->post('start');
        $search = $this->input->post('search')['value'];
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $getPeriksaLab = $this->ModelPemeriksaanLaborat->getPeriksaLab($tglAwal, $tglAkhir, $start, $length)->result();
        // var_dump($getPeriksaLab);
        // die();
        $recordTotal = $this->ModelPemeriksaanLaborat->countPeriksaLab($tglAwal, $tglAkhir, $search)->num_rows();

        $data = [];
        if (!empty($tglAwal) && !empty($tglAkhir)) {
            foreach ($getPeriksaLab as $pl) {;
                $row = [];
                $kode = '<table class="table table-borderless">
                <tr>
                <td>' . $pl->kd_jenis_prw . '</td>
                </tr> 
                </table>';
                $detail = '<table class="table table-borderless">
                    <tr>
                    <td>' . $pl->nm_perawatan . '</td>
                    </tr> 
                </table>';
                $jml = '<table class="table table-borderless">
                    <tr>
                    <td>' . $pl->jml_periksa . '</td>
                    </tr> 
                </table>';
                $pr = '<table class="table table-borderless">
                    <tr>
                    <td>' . $pl->lk . '</td>
                    </tr> 
                </table>';
                $lk = '<table class="table table-borderless">
                    <tr>
                    <td>' . $pl->perempuan . '</td>
                    </tr> 
                </table>';
                $getDetailPeriksaLab = $this->ModelPemeriksaanLaborat->getDetailPeriksaLab($tglAwal, $tglAkhir, $pl->kd_jenis_prw, $search)->result();
                if (!empty($tglAwal) && !empty($tglAkhir)) {
                    foreach ($getDetailPeriksaLab as $value) {
                        $detail .= '<table class="table table-borderless">  
                            <tr>
                            <td>' . $value->pemeriksaan . '</td>
                            </tr> 
                        </table>';
                        $jml .= '<table class="table table-borderless">
                            <tr>
                            <td>' . $value->jml_detail . '</td>
                            </tr> 
                        </table>';
                        $pr .= '<table class="table table-borderless">
                            <tr>
                            <td>' . $value->lk . '</td>
                            </tr> 
                        </table>';
                        $lk .= '<table class="table table-borderless">
                            <tr>
                            <td>' . $value->perempuan . '</td>
                            </tr> 
                        </table>';
                    }
                }

                $row[] = $kode;
                $row[] = $detail;
                $row[] = $jml;
                $row[] = $pr;
                $row[] = $lk;
                $data[] = $row;
            }
        }

        $datajson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];



        echo json_encode($datajson);
    }

    public function export_excel($tglAwal1, $tglAkhir2)
    {
        $PeriksaLab = $this->ModelPemeriksaanLaborat->excelGetPeriksaLab($tglAwal1, $tglAkhir2)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Periksa_laborat.xlsx"');
        header('Cache-Control: max-age=0');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Kode');
        $activeWorksheet->setCellValue('B1', 'Nama Pemeriksaan');
        $activeWorksheet->setCellValue('C1', 'Jumlah Pemeriksaan');
        $activeWorksheet->setCellValue('D1', 'Laki-Laki');
        $activeWorksheet->setCellValue('E1', 'Perempuan');
        $writer = new Xlsx($spreadsheet);
        $row = 2;

        foreach ($PeriksaLab as $pl) {
            $activeWorksheet->setCellValue('A' . $row, $pl->kd_jenis_prw);
            $activeWorksheet->setCellValue('B' . $row, $pl->nm_perawatan);
            $activeWorksheet->setCellValue('C' . $row, $pl->jml_periksa);
            $activeWorksheet->setCellValue('D' . $row, $pl->lk);
            $activeWorksheet->setCellValue('E' . $row, $pl->perempuan);

            $getDetailPeriksaLab = $this->ModelPemeriksaanLaborat->getDetailPeriksaLab($tglAwal1, $tglAkhir2, $pl->kd_jenis_prw)->result();
            $row++;
            foreach ($getDetailPeriksaLab as $detail) {
                $activeWorksheet->setCellValue('A' . $row, $detail->kd_jenis_prw);
                $activeWorksheet->setCellValue('B' . $row, $detail->pemeriksaan);
                $activeWorksheet->setCellValue('C' . $row, $detail->jml_detail);
                $activeWorksheet->setCellValue('D' . $row, $detail->lk);
                $activeWorksheet->setCellValue('E' . $row, $detail->perempuan);
                $row++;
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
