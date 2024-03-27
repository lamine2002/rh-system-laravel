<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailAlertFormRequest;
use App\Models\MailAlert;
use Illuminate\Http\Request;

class MailAlertController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MailAlert::class, 'mail_alert');
    }

    public function index()
    {
        $mail_alerts = MailAlert::orderBy('created_at', 'desc')->paginate(10);
        return view('rh.mail-alerts.index',
            [
                'mail_alerts' => $mail_alerts
            ]
        );
    }

    public function create()
    {
        return view('rh.mail-alerts.form',
            [
                'mail_alert' => new MailAlert(),
                'staffs' => \App\Models\Staff::all(),
                'types' => ['email', 'sms']
            ]
        );
    }

    public function store(MailAlertFormRequest $request)
    {
        MailAlert::create($request->validated());
        return redirect()->route('rh.mail-alerts.index')->with('success', 'Alerte mail crée avec succès');
    }

    public function edit(MailAlert $mail_alert)
    {
        return view('rh.mail-alerts.form',
            [
                'mail_alert' => $mail_alert,
                'staffs' => \App\Models\Staff::all(),
                'types' => ['email', 'sms']
            ]
        );
    }

    public function update(MailAlertFormRequest $request, MailAlert $mail_alert)
    {
        $mail_alert->update($request->validated());
        return redirect()->route('rh.mail-alerts.index')->with('success', 'Alerte mail modifiée avec succès');
    }

    public function destroy(MailAlert $mail_alert)
    {
        $mail_alert->delete();
        return redirect()->route('rh.mail-alerts.index')->with('success', 'Alerte mail supprimée avec succès');
    }
}
