/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

export default () => {
    const form = document.getElementById('careerForm') as HTMLFormElement;

    if (!form) {
        return 0;
    }

    let salary = 0;
    let jobName = '-';

    const jobs: HTMLDivElement[] = Array.from(document.querySelectorAll('[data-job="true"]'));
    const buttons: HTMLLinkElement[] = Array.from(document.querySelectorAll('[data-set-job="true"]'));

    const salaryInp = form.querySelector('select[name="salary"]') as HTMLSelectElement;
    const jobNameInp = form.querySelector('select[name="jobName"]') as HTMLSelectElement;
    const jobFullNameInp = form.querySelector('input[name="jobFullName"]') as HTMLInputElement;
    const phone = form.querySelector('input[name="phone"]') as HTMLInputElement;

    const handleSalary = () => {
        jobs.forEach(job => job.style.display = parseInt(job.dataset.salary as string) < salary ? 'none' : 'block');

        const activeJobs = jobs.filter(el => el.style.display !== 'none').map(el => el.dataset.jobName);
        Array.from(jobNameInp.options).forEach(option => {
            option.style.display = activeJobs.includes(option.value) || option.value === '-' ? 'block' : 'none';
        });
    }

    const handleJobNames = () => {
        jobs.forEach(job => {
            const cond = (job.dataset.jobName === jobName || jobName === '-') && parseInt(job.dataset.salary as string) >= salary;
            job.style.display = cond ? 'block' : 'none'
        });
    }

    buttons.forEach(btn => btn.addEventListener('click', () => {
        const jobEl = btn.closest('[data-salary]') as HTMLDivElement;

        salary = parseInt(jobEl.dataset.salary as string);
        jobName = jobEl.dataset.jobName as string

        salaryInp.value = salary.toString();
        jobNameInp.value = jobName;
        jobFullNameInp.value = jobEl.dataset.jobFullName as string;

        handleSalary();
        handleJobNames();

        const timeout = setTimeout(() => {
            phone.focus({preventScroll: true});
            (form.querySelector('[type="submit"]') as HTMLButtonElement).click();
            clearTimeout(timeout);
        }, 550);
    }));

    salaryInp.addEventListener('change', ({currentTarget}) => {
        salary = parseInt((currentTarget as HTMLInputElement).value);
        handleSalary()
        jobNameInp.value = '-';
    });

    jobNameInp.addEventListener('change', ({currentTarget}) => {
        jobName = (currentTarget as HTMLInputElement).value;
        handleJobNames()
    });
}