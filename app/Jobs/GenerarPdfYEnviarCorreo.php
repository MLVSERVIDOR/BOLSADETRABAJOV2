<?php

namespace App\Jobs;

use App\Mail\MunicipalidadMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class GenerarPdfYEnviarCorreo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $infraccion;
    protected $vehiculo;
    protected $administrado;
    protected $idunico;
    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($infraccion, $vehiculo, $administrado, $idunico, $email = null)
    {
        $this->infraccion = $infraccion;
        $this->vehiculo = $vehiculo;
        $this->administrado = $administrado;
        $this->idunico = $idunico;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Generar el PDF
        $pdf = Pdf::loadView('fiscalizador.ControlFiscalizacion.pdfActaNoConforme', [
            'infraccion' => $this->infraccion,
            'vehiculo' => $this->vehiculo,
            'administrado' => $this->administrado,
        ])->setPaper([0, 0, 226.77, 841.89], 'portrait')
          ->setOptions(['defaultFont' => 'sans-serif', 'margin' => [0, 0, 0, 0]]);

        // Guardar el PDF en el almacenamiento
        $fileName = 'ActaConforme_' . time() . '.pdf';
        Storage::disk('public')->put('archivosFiscalizador/ActaNoConforme/pdf/' . $fileName, $pdf->output());

        // Actualizar la base de datos
        DB::table('constancias_actas')->where('nro_acta', $this->idunico)->update([
            'pdf' => 'archivosFiscalizador/ActaNoConforme/pdf/' . $fileName,
        ]);

        // Enviar el correo si existe el email
        if ($this->email) {
            $pdfPath = Storage::disk('public')->path('archivosFiscalizador/ActaNoConforme/pdf/' . $fileName);
            Mail::to($this->email)->send(new MunicipalidadMail($pdfPath));
        }
    }
}
