/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

import { Field } from '../../../vendor/strategio/contentio-sdk/assets/typescript/Utils/FormValidator/types'
import { trackLeadGenerate } from '../../../vendor/strategio/contentio-sdk/assets/typescript/Components/Measurement'
import Axios from '../../../vendor/strategio/contentio-sdk/assets/typescript/Plugins/Axios'
import { IFormValidator } from '../../../vendor/strategio/contentio-sdk/assets/typescript/Utils/FormValidator'

type ContactFormValues = {
    salary: string,
    jobName: string,
    jobFullName: string,
    phone: string,
}

export default (formValidator: IFormValidator, form: HTMLFormElement | null, rules: Field[]) => {
    if (form) {
        formValidator.validate(form, rules, async () => await process(form))

        const process = async (form: HTMLFormElement) => {
            const btn = form.querySelector('button[type="submit"]') as HTMLButtonElement
            const params = Object.fromEntries(new FormData(form).entries()) as ContactFormValues

            btn.disabled = true
            formValidator.clearAlerts(form)

            try {
                await Axios.post('lead/create', { type: 'careerForm', params })
                formValidator.addAlert(form, false, 'Děkujeme, do 24 hodin se Vám na uvedený kontakt ozveme.')
                trackLeadGenerate('career')
                form.reset()
            } catch (err: any) {
                formValidator.addAlert(form, true, 'Akce se nezdařila. Zadali jste správný kontakt?')
            }

            btn.disabled = false
        }
    }
}