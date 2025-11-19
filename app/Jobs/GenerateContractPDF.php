<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PDF;
use App\Models\Contract;

class GenerateContractPDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contract;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $contract = $this->contract;

        // Generate PDF
        $pdf = PDF::loadView('admin.contract.pdf', compact('contract'))
            ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

        // Define the PDF path
        $destinationPath = public_path('uploads/contracts/');
        $pdfPath = $destinationPath . 'contract_' .uniqid() . $contract->id . '.pdf';

        // Save the PDF to the storage
        $pdf->save($pdfPath);

        // Update the contract record with the PDF path
        $contract->update(['contract_pdf' => 'uploads/contracts/contract_' . $contract->id . '.pdf']);
    }
}
